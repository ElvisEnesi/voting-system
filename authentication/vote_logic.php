<?php
    // include files
    require __DIR__ . '/../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    $mail = new PHPMailer(true);

    require_once '../configuration/database.php';
    require_once '../encryption/encryption.php';
    // get party details from url
    if (isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    } else {
        header("Location: " . root_url . "accessible/candidate.php");
        exit();
    }
    if (isset($_POST['submit'])) {
        $get_party = mysqli_prepare($connection, "SELECT * FROM candidate WHERE id=?");
        mysqli_stmt_bind_param($get_party, "i", $id);
        mysqli_stmt_execute($get_party);
        $party = mysqli_fetch_assoc(mysqli_stmt_get_result($get_party));
        $party_name = $party['party'];
        // get user details from database
        $user_id = $_SESSION['user_id'];
        $get_user = mysqli_prepare($connection, "SELECT * FROM user WHERE id=?");
        mysqli_stmt_bind_param($get_user, "i", $user_id);
        mysqli_stmt_execute($get_user);
        $user = mysqli_fetch_assoc(mysqli_stmt_get_result($get_user));
        $decrypted_nin = decrypt_data($user['nin']);
        $decrypted_email = decrypt_data($user['email']);
        // declare variables
        $otp = filter_var($_POST['otp'], FILTER_SANITIZE_NUMBER_INT);
        // validate inputs
        if (!is_numeric($otp)) {
            $_SESSION['add_user'] = "OTP should be a number!!";
        } else {
            // check if email or nin exists already
            $select = mysqli_prepare($connection, "SELECT * FROM otp WHERE user_id=? ORDER BY date DESC LIMIT 1");
            mysqli_stmt_bind_param($select, "i", $user_id);
            mysqli_stmt_execute($select);
            $result = mysqli_stmt_get_result($select);
            if (mysqli_num_rows($result) > 0) {
                // decrypt otp
                $row = mysqli_fetch_assoc($result);
                $decrypted_opt = decrypt_data($row['otp']);
                $date = $row['date'];
                // Convert DB time and current time to Unix Timestamps for a fair comparison
                if ($decrypted_opt != $otp) {
                    $_SESSION['add_user'] = "Invalid OTP!!";
                } else {
                    // check if it's expired       
                    if (time() - strtotime($date) > 600) { // 600 seconds = 10 minutes
                        $_SESSION['add_user'] = "OTP expired!!";
                    }
                }
            } else {
                $_SESSION['add_user'] = "OTP not found!!";
            }
        }
        // redirect if there's any error
        if (isset($_SESSION['add_user'])) {
            header("location: " . root_url . "authentication/otp.php?id=" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8'));
            exit();
        } else {
            // encrypt nin before inserting into database
            $encrypted_nin = encrypt_data($decrypted_nin);
            // insert into database
            $stmt = mysqli_prepare($connection, "INSERT INTO votes (user_id, nin, party) VALUES(?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "iss", $user_id, $encrypted_nin, $party_name);
            mysqli_stmt_execute($stmt);
            if (!mysqli_errno($connection)) {
                try {

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'jattoelvis00@gmail.com';
                    $mail->Password = 'mreaymritfrhhrkh';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('janedoe@gmail.com', 'Custech Voting System');
                    $mail->addAddress($decrypted_email); 

                    $mail->isHTML(true);
                    $mail->Subject = 'Voting Confirmation';
                    $mail->Body = 'Your vote has been casted successfully, thank you for voting with us.';

                    $mail->send();
                    // echo "<div class='notice'>Email sent successfully!</div>";

                } catch (Exception $e) {
                    echo "Error: {$mail->ErrorInfo}";
                }
                if (isset($_SESSION['user_is_admin'])) {
                    header("location: " . root_url . "admin/dashboard.php");
                    exit();
                } else {
                    header("location: " . root_url . "user/dashboard.php");
                    exit();
                }
            } else {
                $_SESSION['add_user'] = "Error creating user!!";
                header("location: " . root_url . "authentication/otp.php?id=" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8'));
                exit();
            }
        }
    } else {
        header("location: " . root_url . "authentication/otp.php?id=" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8'));
        exit();
    }
    