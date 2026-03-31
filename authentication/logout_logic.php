<?php
    // include files
    require_once '../configuration/database.php';
    include "./authorization/logged_user.php";
    // logout logic
    session_unset();
    session_destroy();
    header("location: " . root_url . "accessible/index.php");