<?php require_once 'header.php'; ?>
<body>
    <div class="signup-container">
        <h2>Signup</h2>
        <form id="signupForm">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="button" onclick="signup()" value="Signup">
        </form>
        <div class="login-link">
            <a href="login.php">Login</a>
        </div>
    </div>
</body>
<?php require_once 'footer.php'; ?>
</html>
