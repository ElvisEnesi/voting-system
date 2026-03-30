<?php
    // include files
    require_once './configuration/database.php';
    include "./authorization/authorized_user.php";
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
        // unlink previous picture before pushing new one
        if ($previous_picture_path) {
            unlink($previous_picture_path);
        }
        // delete from database
        $stmt = mysqli_prepare($connection, "DELETE FROM candidate WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id); 
        mysqli_stmt_execute($stmt);
        if (!mysqli_errno($connection)) {
            $_SESSION['delete_candidate_success'] = "Successfuly deleted a candidate!!";
            header("location: " . root_url . "admin/dashboard.php#Candidates");
            exit();
        } else {
            // redirect with session message
            $_SESSION['delete_candidate'] = "Error deleting candidate!!";
            header("location: " . root_url . "admin/dashboard.php");
            exit();
        }
    }
        