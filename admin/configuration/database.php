<?php
    // declare database variables
    $database_username = 'root';
    $server = 'localhost';
    $database_name = 'voting_system';
    $database_password = '';
    // make connection
    $connection = new mysqli($server, $database_username, $database_password, $database_name);
    // check connection
    if (mysqli_error($connection)) {
        die("connection failed: " . mysqli_error($connection));
    } else {
        echo "connection successful";
    }
    

