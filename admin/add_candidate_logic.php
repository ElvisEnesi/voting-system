<?php
    // include files
    require_once './configuration/database.php';
    include "./authorization/authorized_user.php";
    if (isset($_POST['submit'])) {
        // declare variables
        $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $party = filter_var($_POST['party'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $avatar = $_FILES['picture'];
        // validate inputs
        if (!$title || !$party || !$avatar['name']) {
            $_SESSION['add_candidate'] = "Fill all inputs!!";
        } else {
            // process image if no errors
            $time = time();
            $avatar_name = $time . "_" . $avatar['name']; // make time unique using time stamp
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_file_path = "../images/candidates/" . $avatar_name;
            // make array of allowed files
            $allowed_files = ['image/jpeg', 'image/jpg', 'image/png'];
            // sanitize the extentions
            $file_open = finfo_open(FILEINFO_MIME_TYPE);
            $type = finfo_file($file_open, $avatar_tmp_name);
            // check array
            if (!in_array($type, $allowed_files)) {
                $_SESSION['add_candidate'] = "File must be jpg, jpeg or png!!";
            } else {
                if ($avatar['size'] > 2_000_000) {
                    $_SESSION['add_candidate'] = "File must be less than 2mb!!";
                }
            }
        }
        // redirect if there's any error
        if (isset($_SESSION['add_candidate'])) {
            header("location: " . root_url . "admin/add_candidate.php");
            exit();
        } else {
            // insert into database
            $stmt = mysqli_prepare($connection, "INSERT INTO candidate (party, title, picture) VALUES(?,?,?)");
            mysqli_stmt_bind_param($stmt, "sss", $party, $title, $avatar_name); 
            mysqli_stmt_execute($stmt);
            if (!mysqli_errno($connection)) {
                move_uploaded_file($avatar_tmp_name, $avatar_file_path);
                $_SESSION['add_candidate_success'] = "Successfuly added a candidate!!";
                header("location: " . root_url . "admin/dashboard.php#Candidates");
                exit();
            } else {
                $_SESSION['add_candidate'] = "Error creating candidate!!";
                header("location: " . root_url . "admin/dashboard.php");
                exit();
            }
        }
    } else {
        header("location: " . root_url . "admin/add_candidate.php");
        exit();
    }
    