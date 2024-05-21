<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: ./login.php");
    exit();
}else if($_SESSION["id"] == 42069){
    header("Location: ./admin.php");
    exit();
}


include_once 'header.php';
include_once '.env/db.php'; // Include the database connection

$id = $_SESSION["id"];

// Fetch user data from the database
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    header("Location: login.php");
    exit();
}
?>

<body>
    <div class="container">
        <div class="left">
            <div class="profile-container">
                <h1>Profile</h1>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

                <!-- Edit Profile Section -->
                <div class="edit-profile">
                    <h2>Edit Profile</h2>
                        <label for="new_username">New Username:</label>
                        <input type="text" id="new_username" name="new_username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>
                        
                        <label for="new_email">New Email:</label>
                        <input type="email" id="new_email" name="new_email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
                        
                        <button onclick="updateprofile(<?php echo $_SESSION['id']  ?>)" type="submit" class="update-button">Update Profile</button>
                </div>

            </div>

            <div class="profile-container">
                <div class="add-book">
                    <h2>Add a Book</h2>

                    <label for="ISBN">ISBN:</label>
                    <input type="text" id="ISBN" name="ISBN" required><br>

                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required><br>
                    
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" required><br>
                    
                    <label for="genre">Genre:</label>
                    <input type="text" id="genre" name="genre" required><br>
                    
                    <label for="year">Year:</label>
                    <input type="number" id="year" name="year" required><br>
                    
                    <button onclick="addbook(<?php echo $_SESSION['id'] ?>)" class="add-button">Add Book</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
                <table id="booksTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch user's books from the database
                        $sql = "SELECT * FROM books WHERE user_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $user['id']);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($book = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($book['ISBN']) . "</td>";
                                echo "<td>" . htmlspecialchars($book['title']) . "</td>";
                                echo "<td>" . htmlspecialchars($book['author']) . "</td>";
                                echo "<td>" . htmlspecialchars($book['genre']) . "</td>";
                                echo "<td>" . htmlspecialchars($book['year']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No books found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#booksTable').DataTable({
                "paging": true,
                "pageLength": 40, // Adjust the number of records per page
                "lengthChange": false,
                "info": false
            });
        });
    </script>
</body>

<?php
include_once 'footer.php';
?>
