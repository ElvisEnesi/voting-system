<?php
    include('../smtp/mail.php');
    // get party details
    if (isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    } else {
        header("Location: " . root_url . "accessible/candidate.php");
        exit();
    }
    if (isset($_POST['vote'])) {
        // redirect to otp page
        header("location: " . root_url . "authentication/otp.php?id=" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8'));
        exit();
    } else {
        header("location: " . root_url . "accessible/candidate.php");
        exit();
    }
    