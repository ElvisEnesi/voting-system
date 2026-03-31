<?php
    // include files
    include('./configuration/database.php');
    include "./authorization/authorized_user.php";
    include "./authorization/logged_user.php";
    // get id from url
    if (isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    } else {
        // redirect to dashbaord
        header("location: " . root_url . "admin/dashboard.php#Candidates");
    }
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
    <h1>Delete room!!</h1>
    <div class="confirm">
        <a href="<?= root_url ?>admin/delete_candidate_logic.php?id=<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>">Yes</a>
        <a href="<?= root_url ?>admin/dashboard.php#Candidates">No</a>
    </div>
</body>
</html>