<?php
    require '../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;

    $mail = new PHPMailer();
    // start session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // define constant
    define("root_url", "http://localhost/voting-system/");
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
        // echo "connection successful";
    }
    // set default timezone
    date_default_timezone_set('Africa/Lagos');
    

