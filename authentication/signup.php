<?php
    include "../configuration/database.php";
    echo $server;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="log show">
        <h2>Sign up</h2>
        <div class="form">
            <form action="<?= root_url ?>authentication/signup_logic.php" method="post" enctype="multipart/form-data">
                <input type="text" name="full_name" placeholder="Your full name!!">
                <input type="number" name="nin" placeholder="Your user nin!!">
                <input type="email" name="email" placeholder="Your email!!">
                <input type="password" name="Create" placeholder="Create password!!">
                <input type="password" name="Confirm" placeholder="Confirm password!!">
                <input type="file" name="avatar">
                <button type="submit" name="submit">Submit</button>
            </form>
            <div class="note">
                Don't have an account? <a href="<?= root_url ?>authentication/signin.php">Log in</a>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>