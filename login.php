<?php require_once 'header.php'; ?>

<body>
    <div class="login-container">
        <h1>Login</h1>
        <form id="loginForm">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <input type="button" onclick="login();" value="Login">
        </form>
        <div class="signup-link">
            <a href="signup.php">Sign Up</a>
        </div>
    </div>
</body>
<?php require_once 'footer.php'; ?>
</html>
