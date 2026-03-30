<?php
    // include files
    include('./configuration/database.php');
    include "./authorization/authorized_user.php";
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
        if (isset($_SESSION['add_candidate'])) {
            echo "<div class='notice'>" . $_SESSION['add_candidate'] . "</div>";
        }
        unset($_SESSION['add_candidate']);
    ?>
    <section class="log show">
        <h2>Add candidates</h2>
        <div class="form">
            <form action="add_candidate_logic.php" method="post" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Title">
                <input type="text" name="party" placeholder="party">
                <input type="file" name="picture">
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </section>
    <script src="<?= root_url ?>javascript/script.js"></script>
</body>
</html>