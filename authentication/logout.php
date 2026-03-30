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
    <h1>Log out!!</h1>
    <div class="confirm">
        <a href="<?= root_url ?>authentication/logout_logic.php">Yes</a>
        <?php if (isset($_SESSION['user_is_admin'])) : ?>
            <a href="<?= root_url ?>admin/dashboard.php">No</a>
        <?php else : ?>
            <a href="<?= root_url ?>user/dashboard.php">No</a>
        <?php endif; ?>
    </div>
</body>
</html>