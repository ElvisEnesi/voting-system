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
        if (isset($_SESSION['add_user_success'])) {
            echo "<div class='notice'>" . $_SESSION['add_user_success'] . "</div>";
        }
        unset($_SESSION['add_user_success']);
    ?>
    <?php
        if (isset($_SESSION['sign_user'])) {
            echo "<div class='notice'>" . $_SESSION['sign_user'] . "</div>";
        }
        unset($_SESSION['sign_user']);
    ?>
    <section class="log show">
        <h2>Sign in</h2>
        <div class="form">
            <form action="<?= root_url ?>authentication/signin_logic.php" method="post">
                <input type="email" name="email" placeholder="Your email!!">
                <input type="password" name="password" id="password" placeholder="Your password!!">
                <div class="check">
                    <label for="check">Show password</label>
                    <input type="checkbox" name="check" id="check" onclick="show_login_key()">
                </div>
                <button type="submit" name="submit">Submit</button>
            </form>
            <div class="note">
                Don't have an account? <a href="<?= root_url ?>authentication/signup.php">Register</a>
            </div>
            <div class="note">
                Forgotten your password? <a href="<?= root_url ?>authentication/forgotten_password.php">Recover</a>
            </div>
        </div>
    </section>
    <script src="<?= root_url ?>javascript/script.js"></script>
</body>
</html>