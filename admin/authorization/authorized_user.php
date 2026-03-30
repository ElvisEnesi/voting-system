<?php
    // include files
    // give authority
    if (!isset($_SESSION['user_is_admin'])) {
        // redirect to checkpoint
        header("location: " . root_url . "flagged_user/checkpoint.php");
    }
    