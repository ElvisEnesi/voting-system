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
        <a href="">Yes</a>
        <a href="<?= root_url ?>admin/dashboard.php">No</a>
    </div>
</body>
</html>