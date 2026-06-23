<?php
    require __DIR__ . '/../configuration/database.php';
    require_once '../encryption/encryption.php';
    require __DIR__ . '/../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    $mail = new PHPMailer(true);
    // echo "PHPMailer loaded successfully";
    $user_id = $_SESSION['user_id']; // replace with actual user ID from session or authentication system
    // create a random 6 digit OTP
    $otp = encrypt_data(rand(100000, 999999));
    // search for active opt for the user
    $stmt = mysqli_prepare($connection, "SELECT * FROM otp WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        // delete existing OTP for the user
        $stmt = mysqli_prepare($connection, "DELETE FROM otp WHERE user_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
    }
    // insert new OTP into database with expiration time of 10 minutes
    $stmt = mysqli_prepare($connection, "INSERT INTO otp (user_id, otp) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "is", $user_id, $otp);
    mysqli_stmt_execute($stmt);
    // get user details from database
    $get_user = mysqli_prepare($connection, "SELECT * FROM user WHERE id=?");
    mysqli_stmt_bind_param($get_user, "i", $user_id);
    mysqli_stmt_execute($get_user);
    $user = mysqli_fetch_assoc(mysqli_stmt_get_result($get_user));
    $decrypted_nin = decrypt_data($user['nin']);
    $decrypted_email = decrypt_data($user['email']);

    // decrypt OTP before sending email
    $decrypted_otp = decrypt_data($otp);

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jattoelvis00@gmail.com';
        $mail->Password = 'qwlqursqalvsewcf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('jattoelvis00@gmail.com', 'Custech Voting System');
        $mail->addAddress($decrypted_email); 

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Voting System';
        $mail->Body = 'Here is your OTP: ' . $decrypted_otp . ' Please use this OTP to complete your voting process for it will expire in 10 minutes.';

        $mail->send();
        echo "<div class='notice'>Email sent successfully!</div>";

    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }