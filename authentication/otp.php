<?php
    include('../configuration/database.php');
    include "./authorization/logged_user.php";
    require_once '../security/ip.php';
    // select log flow for users ip_address
    $select_ip = mysqli_prepare($connection, "SELECT COUNT(*) AS attempt FROM vote_log WHERE status = ? AND ip_address = ? 
    AND date >= NOW() - INTERVAL 10 MINUTE");
    // declare status
    $status = "failure";
    mysqli_stmt_bind_param($select_ip, "ss", $status, $user_ip);
    mysqli_stmt_execute($select_ip);
    $ip_result = mysqli_fetch_assoc(mysqli_stmt_get_result($select_ip));
    $failed_ip = $ip_result['attempt'];
    // get party details
    if (isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    } else {
        header("Location: " . root_url . "accessible/candidate.php");
        exit();//
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
                <?php if ($failed_ip >= 3) : ?>
                    <?php
                        // attempt
                        $vote_flow = mysqli_prepare($connection, "INSERT INTO threats (type, ip_address) VALUES(?, ?)");
                        // status
                        $threat = "Unknown OTP";
                        // bind param & execute
                        mysqli_stmt_bind_param($vote_flow, "ss", $threat, $user_ip);
                        mysqli_stmt_execute($vote_flow);
                    ?>
                    <div class="notice">Too many failed attempt, try after 30 minutes</div>
                <?php else : ?>
                    <button type="submit" name="submit">Submit</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="note">
            Cancel process?<a href="<?= root_url ?>accessible/candidate.php">Cancel</a>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>