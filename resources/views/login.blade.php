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

            <form action="#" method="POST" id="login-form">
                <div class="textbox">
                    <input type="text" placeholder="Username" name="email" required>
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
<script>

    document.getElementById('login-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let data = {
            email: formData.get('email'),
            password: formData.get('password')
        };

        try {
            const response = await fetch('api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            if (response.ok) {
                // Store the token in localStorage
                localStorage.setItem('access_token', result.access_token);
                localStorage.setItem('id', result.id);
                localStorage.setItem('name', result.name);
                // Redirect to dashboard or any protected route
                 //window.location.href = 'home';
                 window.location.assign('home');
               // window.location.href = 'dashboard';
            } else {
                alert(result.error);
            }
        } catch (error) {
            console.error('Login error', error);
        }
    });

    </script>
</html>
