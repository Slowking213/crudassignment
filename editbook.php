<?php
session_start();
include '.env/db.php';
include 'header.php';
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['id'] == 42069) {
    $ISBN = $_POST['ISBN'];
    $title = $_POST['Title'];
    $author = $_POST['Author'];
    $genre = $_POST['Genre'];
    $year = $_POST['Year'];
    $Owner = $_POST['Owner'];

    ?>
    <div class="profile-container">
                <div class="add-book">
                    <h2>Edit Book</h2>

                    <form action="operators/editbook.php" method = "post">
                    <label for="ISBN">ISBN:</label>
                    <input type="text" id="ISBN" name="ISBN" required value="<?php echo $ISBN  ?>"><br>

                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required value="<?php echo $title  ?>"><br>
                    
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" required value="<?php echo $author ?>"><br>
                    
                    <label for="genre">Genre:</label>
                    <input type="text" id="genre" name="genre" required value="<?php echo $genre  ?>"><br>
                    
                    <label for="year">Year:</label>
                    <input type="number" id="year" name="year" required value="<?php echo $year  ?>"><br>

                    <label for="owner">Owner:</label>
                    <input type="number" id="year" name="user_id" required value="<?php echo $Owner  ?>"><br>

                    <input type="hidden" name="id" value="<?php echo $ISBN ?>">
                    

                    <div style = "display: flex; flex-direction: row; justify-content : space-between">
                        <form action = "admin.php" method="POST">
                        <button type ="submit" class="add-button">Edit Book</button>
                        </form>

                        <form action = "admin.php" method="POST">
                        <button type ="submit" class="delete-btnn">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
    <?php
}
else
{
    header("Location: error.php");
}

?>