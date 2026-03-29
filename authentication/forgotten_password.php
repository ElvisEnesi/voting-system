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
    <section class="log show">
        <h2>Recover your password!!</h2>
        <div class="form">
            <form action="" method="post">
                <input type="email" name="email" placeholder="Your email!!">
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>