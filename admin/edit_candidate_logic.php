<?php
    // include files
    require_once './configuration/database.php';
    include "./authorization/authorized_user.php";
    include "./authorization/logged_user.php";
    if (isset($_POST['submit'])) {
        // get id from url
        if (isset($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            // select picture from table
            $candidate_details = mysqli_prepare($connection, "SELECT * FROM candidate WHERE id = ?");
            mysqli_stmt_bind_param($candidate_details, "i", $id);
            mysqli_stmt_execute($candidate_details);
            $candidate_details_result = mysqli_fetch_assoc(mysqli_stmt_get_result($candidate_details));
            $previous_picture = $candidate_details_result['picture'];
            $previous_picture_path = "../images/candidates/" . $previous_picture;
        } 
        // declare variables
        $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $party = filter_var($_POST['party'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $avatar = $_FILES['picture'];
        // validate inputs
        if (!$title || !$party || !$avatar['name']) {
            $_SESSION['edit_candidate'] = "Fill all inputs!!";
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
                $_SESSION['edit_candidate'] = "File must be jpg, jpeg or png!!";
            } else {
                if ($avatar['size'] > 2_000_000) {
                    $_SESSION['edit_candidate'] = "File must be less than 2mb!!";
                }
            }
        }
        // redirect if there's any error
        if (isset($_SESSION['edit_candidate'])) {
            header("location: " . root_url . "admin/edit_candidate.php");
            exit();
        } else {
            // insert into database
            $stmt = mysqli_prepare($connection, "UPDATE candidate SET party = ?, title = ?, picture = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "sssi", $party, $title, $avatar_name, $id); 
            mysqli_stmt_execute($stmt);
            if (!mysqli_errno($connection)) {
                // unlink previous picture before pushing new one
                if ($previous_picture_path) {
                    unlink($previous_picture_path);
                }
                // upload new file
                move_uploaded_file($avatar_tmp_name, $avatar_file_path);
                // redirect with session message
                $_SESSION['edit_candidate_success'] = "Successfuly updated a candidate!!";
                header("location: " . root_url . "admin/dashboard.php#Candidates");
                exit();
            } else {
                // redirect with session message
                $_SESSION['edit_candidate'] = "Error updating candidate!!";
                header("location: " . root_url . "admin/dashboard.php");
                exit();
            }
        }
    } else {
        header("location: " . root_url . "admin/edit_candidate.php");
        exit();
    }
    