<form action="login2" method="POST" id="login-form">
    @csrf
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
