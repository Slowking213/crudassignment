<?php
session_start();
include '.env/db.php';
include 'header.php';
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['id'] == 42069) {
    ?>
    <div class="profile-container">
                <div class="add-book">
                    <h2>Add a Book</h2>
                    <label for="ISBN">ISBN:</label>
                    <input type="text" id="ISBN" name="ISBN" required ><br>

                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required ><br>
                    
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" required ><br>
                    
                    <label for="genre">Genre:</label>
                    <input type="text" id="genre" name="genre" required ><br>
                    
                    <label for="year">Year:</label>
                    <input type="number" id="year" name="year" required ><br>

                    <label for="owner">Owner:</label>
                    <input type="number" id="owner" name="owner" required ><br>

                    <form action = "admin.php" method="get">
                    <button onclick = "addbook()" class="add-button">Add Book</button>
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