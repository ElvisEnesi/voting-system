<?php
    include('./configuration/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting system</title>
    <link rel="stylesheet" href="<?php root_url ?>../css/style.css">
</head>
<body>
    <!--header-->
    <section class="header">
        <div class="logo" onclick="window.location.href='<?php root_url ?>index.php'">Vote</div>
        <!--for media query-->
        <div class="icon">
            <div class="openNav"><ion-icon name="menu-outline"></ion-icon></div>
            <div class="closeNav"><ion-icon name="close-outline"></ion-icon></div>
        </div>
        <div class="nav">
            <div class="dropdown">
                <button class="dropbtn">
                    Home 
                    <div class="drop_icon_open"><ion-icon name="chevron-down-outline"></ion-icon></div>
                </button>   
                <div class="dropdown_links">
                    <a href="">Overview of the hotel</a>
                    <a href="<?php root_url ?>index.php#candidates">Candidates</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">
                    Candidates
                    <div class="drop_icon_open"><ion-icon name="chevron-down-outline"></ion-icon></div>
                </button>
                <div class="dropdown_links">
                    <a href="http://localhost/voting-system/accessible/candidate.php">Candidates</a>
                </div>
            </div>
            <div class="dropdown">
                <button onclick="window.location.href='<?= root_url ?>authentication/signup.php'">Sign in</button>
            </div>
            <div class="dropdown">
                <a href="<?php root_url ?>dashboard.php"><img src="../images/"></a>
            </div>
        </div>
    </section>