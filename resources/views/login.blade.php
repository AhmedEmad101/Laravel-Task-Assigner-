<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>

            <form action="#" method="POST">
                <div class="textbox">
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="textbox">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="remember-me">
                    <input type="checkbox" name="remember"> Remember me
                </div>
                <div class="button">
                    <input type="submit" value="Login">
                </div>
            </form>

            <div class="links">
                <a href="#">Forgot Password?</a>
                <a href="#">Create an Account</a>
            </div>
        </div>
    </div>

</body>
</html>
