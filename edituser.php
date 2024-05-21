<?php
session_start();
include '.env/db.php';
include 'header.php';
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['id'] == 42069) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    ?>
                <div class="profile-container">
                <h1>Profile</h1>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>

                <!-- Edit Profile Section -->
                <div class="edit-profile">
                    <h2>Edit Profile</h2>
                        <label for="new_username">New Username:</label>
                        <input type="text" id="new_username" name="new_username" value="<?php echo htmlspecialchars($username); ?>" required><br>
                        
                        <label for="new_email">New Email:</label>
                        <input type="email" id="new_email" name="new_email" value="<?php echo htmlspecialchars($email); ?>" required><br>
                        
                        <form action = "admin.php" method="POST">
                        <button onclick="updateprofile(<?php echo $id ?>,false)" type="submit" class="update-button">Update Profile</button>
                        </form>
                </div>

            </div>

            <?php

}
else
{
    header("Location: error.php");
}
?>