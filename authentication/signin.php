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
        <h2>Sign in</h2>
        <div class="form">
            <form action="" method="post">
                <input type="number" name="nin" placeholder="Your NIN!!">
                <input type="password" name="password" id="password" placeholder="Your password!!">
                <div class="check">
                    <label for="check">Show password</label>
                    <input type="checkbox" name="check" id="check" onclick="show_login_key()">
                </div>
                <button type="submit" name="submit">Submit</button>
            </form>
            <div class="note">
                Don't have an account? <a href="signup.html">Register</a>
            </div>
            <div class="note">
                Forgotten your password? <a href="forgotten_password.html">Recover</a>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>