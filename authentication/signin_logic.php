<?php
    // include files
    require_once '../configuration/database.php';
    if (isset($_POST['submit'])) {
        // declare variables
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $key = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // validate inputs
        if (!$key || !$email) {
            $_SESSION['sign_user'] = "Fill all inputs!!";
        } else {
            // check for nin
            $stmt = mysqli_prepare($connection, "SELECT * FROM user WHERE email=?");
            mysqli_stmt_bind_param($stmt, "i", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                // fetch details
                $users = mysqli_fetch_assoc($result);
                // display details
                $password = $users['password'];
                // verify password
                if (password_verify($key, $password)) {
                    // login in user
                    $_SESSION['user_id'] = bin2hex($users['uuid']);
                    // set admin role
                    if ($users['is_admin'] == 1) {
                        $_SESSION['user_is_admin'] = true;
                    }
                    // redirect to index page
                    // set index for admin or user
                    if (isset($_SESSION['user_is_admin'])) {
                        header("location: " . root_url . "admin/index.php");
                    } else {
                        header("location: " . root_url . "user/index.php");
                    }
                } else {
                    $_SESSION['sign_user'] = "Password do not match!!";
                }
            } else {
                $_SESSION['sign_user'] = "User not found!!";
            }  
        }
        // redirect if there's any error
        if (isset($_SESSION['sign_user'])) {
            header("location: " . root_url . "authentication/signin.php");
            exit();
        }
    } else {
        header("location: " . root_url . "authentication/signup.php");
        exit();
    }
    