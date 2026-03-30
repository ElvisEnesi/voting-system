<?php
    // include files
    require_once '../configuration/database.php';
    // logout logic
    session_unset();
    session_destroy();
    header("location: " . root_url . "accessible/index.php");