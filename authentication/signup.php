<?php
    include('../configuration/database.php');
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
    <?php
        if (isset($_SESSION['add_user'])) {
            echo "<div class='notice'>" . $_SESSION['add_user'] . "</div>";
        }
        unset($_SESSION['add_user']);//
    ?>
    <section class="log show">
        <h2>Sign up</h2>
        <div class="form">
            <form action="<?= root_url ?>authentication/signup_logic.php" method="post" enctype="multipart/form-data">
                <input type="text" name="full_name" placeholder="Your full name!!">
                <input type="number" name="nin" placeholder="Your user nin!!">
                <input type="email" name="email" placeholder="Your email!!">
                <input type="password" name="create" placeholder="Create password!!">
                <input type="password" name="confirm" placeholder="Confirm password!!">
                <input type="file" name="avatar">
                <button type="submit" name="submit">Submit</button>
            </form>
            <div class="note">
                Don't have an account? <a href="<?= root_url ?>authentication/signin.php">Log in</a>
            </div>
        </div>
    </section>
    <script src="<?= root_url ?>javascript/script.js"></script>
</body>
</html>