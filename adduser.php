<?php
session_start();
include '.env/db.php';
include 'header.php';
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['id'] == 42069) {
    ?>
    <div class="profile-container">
        <div class="edit-profile">
                        <h2>Edit Profile</h2>
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" required><br>
                            
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required><br>

                            <label for="email">Password:</label>
                            <input type="text" id="password" name="password" required><br>
                            
                            <form action = "admin.php" method="get">
                            <button onclick="signup(true)" type="submit" class="update-button">Create Profile</button>
                            </form>
                    </div>
    </div>
    <?php
    include 'footer.php';
}
else
{
    header("Location: error.php");
}

?>