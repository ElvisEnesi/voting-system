<?php
    // include files
    require_once '../security/ip.php';
    // give authority
    if (!isset($_SESSION['user_id'])) {
        $vote_flow = mysqli_prepare($connection, "INSERT INTO threats (type, ip_address) VALUES(?, ?)");
        // status
        $threat = "Unidentified access attempt";
        // bind param & execute
        mysqli_stmt_bind_param($vote_flow, "ss", $threat, $user_ip);
        mysqli_stmt_execute($vote_flow);
        // redirect to checkpoint
        header("location: " . root_url . "flagged_user/checkpoint.php");
    }
    