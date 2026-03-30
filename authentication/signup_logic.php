<?php
    // include files
    require_once '../configuration/database.php';
    require_once '../encryption/encryption.php';
    if (isset($_POST['submit'])) {
        // declare variables
        $name = filter_var($_POST['full_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $search_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $search_nin = filter_var($_POST['nin'], FILTER_SANITIZE_NUMBER_INT);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $nin = filter_var($_POST['nin'], FILTER_SANITIZE_NUMBER_INT);
        $create = filter_var($_POST['create'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirm = filter_var($_POST['confirm'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $avatar = $_FILES['avatar'];
        // validate inputs
        if (!$email || !$name || !$nin || !$confirm || !$create || !$avatar['name']) {
            $_SESSION['add_user'] = "Fill all inputs!!";
        } elseif ($create !== $confirm) {
            $_SESSION['add_user'] = "Passwords don't match!!";
        } elseif (strlen($create) < 8 || strlen($confirm) < 8) {
            $_SESSION['add_user'] = "Passwords should be more than 8 characters!!";
        } elseif (!is_numeric($nin)) {
            $_SESSION['add_user'] = "NIN should be a number!!";
        } else {
            // encrypt details
            $encrypted_email = encrypt_data($email);
            $encrypted_nin = encrypt_data($nin);
            // check if email or nin exists already
            $select = mysqli_prepare($connection, "SELECT * FROM user WHERE hashed_email=? OR hashed_nin=?");
            // hash email for search
            $hashed_email = hash('sha256', $search_email . "MY_SECRET_SALT"); 
            $hashed_nin = hash('sha256', $search_nin . "MY_SECRET_SALT");
            mysqli_stmt_bind_param($select, "ss", $hashed_email, $hashed_nin);
            mysqli_stmt_execute($select);
            $result = mysqli_stmt_get_result($select);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['add_user'] = "Details already used!!";
            }
            // hash passwords
            $hashed_password = password_hash($create, PASSWORD_DEFAULT);
            // process image if no errors
            $time = time();
            $avatar_name = $time . "_" . $avatar['name']; // make time unique using time stamp
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_file_path = "../images/users/" . $avatar_name;
            // make array of allowed files
            $allowed_files = ['image/jpeg', 'image/jpg', 'image/png'];
            // sanitize the extentions
            $file_open = finfo_open(FILEINFO_MIME_TYPE);
            $type = finfo_file($file_open, $avatar_tmp_name);
            // check array
            if (!in_array($type, $allowed_files)) {
                $_SESSION['add_user'] = "File must be jpg, jpeg or png!!";
            } else {
                if ($avatar['size'] > 2_000_000) {
                    $_SESSION['add_user'] = "File must be less than 2mb!!";
                }
            }
        }
        // redirect if there's any error
        if (isset($_SESSION['add_user'])) {
            header("location: " . root_url . "authentication/signup.php");
            exit();
        } else {
            // generate random 16 digits to use as uuid
            // $uuid = random_bytes(16);
            // insert into database
            $stmt = mysqli_prepare($connection, "INSERT INTO user (name, nin, email, hashed_email, hashed_nin, avatar, password) VALUES(?,?,?,?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "sssssss", $name, $encrypted_nin, $encrypted_email, $hashed_email, $hashed_nin, $avatar_name, $hashed_password); 
            // mysqli_stmt_send_long_data($stmt, 5, $uuid);
            mysqli_stmt_execute($stmt);
            if (!mysqli_errno($connection)) {
                move_uploaded_file($avatar_tmp_name, $avatar_file_path);
                $_SESSION['add_user_success'] = "Successful, login!!";
                header("location: " . root_url . "authentication/signin.php");
                exit();
            } else {
                $_SESSION['add_user'] = "Error creating user!!";
                header("location: " . root_url . "authentication/signup.php");
                exit();
            }
        }
    } else {
        header("location: " . root_url . "authentication/signup.php");
        exit();
    }
    