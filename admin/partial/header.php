<?php
    // include files
    include('./configuration/database.php');
    include "./authorization/authorized_user.php";
    include "./authorization/logged_user.php";
    // define logged in user
    $current_user = $_SESSION['user_id'] ?? null;
    // select users details
    $select_user = mysqli_prepare($connection, "SELECT * FROM user WHERE id=?");
    mysqli_stmt_bind_param($select_user, "i", $current_user);
    mysqli_stmt_execute($select_user);
    $user_result = mysqli_fetch_assoc(mysqli_stmt_get_result($select_user));
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
        <div class="logo" onclick="window.location.href='<?php root_url ?>index.php'">Custech Voting System</div>
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
            <?php if (!isset($_SESSION['user_id'])) : ?>
                <div class="dropdown">
                    <button onclick="window.location.href='<?= root_url ?>authentication/signin.php'">Sign in</button>
                </div>
            <?php else : ?>
                <div class="dropdown">
                    <a href="<?php root_url ?>dashboard.php"><img src="../images/users/<?= htmlspecialchars($user_result['avatar'], ENT_QUOTES,'UTF-8') ?>"></a>
                </div>
            <?php endif; ?>
        </div>
    </section>