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
        <h2>Confirm OTP</h2>
        <div class="form">
            <form action="" method="post">
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