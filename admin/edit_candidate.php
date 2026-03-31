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
    // select id candidate
    $select_candidate = mysqli_prepare($connection, "SELECT * FROM candidate WHERE id = ?");
    mysqli_stmt_bind_param($select_candidate, "i", $id);
    mysqli_stmt_execute($select_candidate);
    $candidate_result = mysqli_fetch_assoc(mysqli_stmt_get_result($select_candidate));
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
        if (isset($_SESSION['edit_candidate'])) {
            echo "<div class='notice'>" . $_SESSION['edit_candidate'] . "</div>";
        }
        unset($_SESSION['edit_candidate']);
    ?>
    <section class="log show">
        <h2>Edit candidates</h2>
        <div class="form">
            <form action="<?php root_url ?>edit_candidate_logic.php?id=<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>" method="post" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Title" value="<?= htmlspecialchars($candidate_result['title'], ENT_QUOTES, 'UTF-8') ?>">
                <input type="text" name="party" placeholder="party" value="<?= htmlspecialchars($candidate_result['party'], ENT_QUOTES, 'UTF-8') ?>">
                <input type="file" name="picture">
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </section>
    <script src="<?= root_url ?>javascript/script.js"></script>
</body>
</html>