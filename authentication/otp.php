<?php
    include('../configuration/database.php');
    // get party details
    if (isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    } else {
        header("Location: " . root_url . "accessible/candidate.php");
        exit();
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
    <?php
        if (isset($_SESSION['add_user'])) {
            echo "<div class='notice'>" . $_SESSION['add_user'] . "</div>";
        }
        unset($_SESSION['add_user']);//
    ?>
    <section class="log show">
        <h2>Confirm OTP</h2>
        <div class="form">
            <form action="<?= root_url ?>authentication/vote_logic.php?id=<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>" method="post">
                <input type="number" name="otp" placeholder="Insert OTP!!">
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
        <div class="note">
            Cancel process?<a href="<?= root_url ?>admin/dashboard.php#settings">Cancel</a>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>