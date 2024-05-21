<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
} else if ($_SESSION['id'] != 42069) {
    header("Location: error.php");
    exit();
}

include_once 'header.php';
include '.env/db.php';
?>


<style>
        .container {
            margin-top: 20px;
        }
        .logout-button {
            float: right;
            margin-top: 10px;
        }
        .table-section {
            margin-bottom: 30px;
        }
    </style>
<body>
<div class="container">    
    <div style = "margin-right : 50px" class="table-section">
        <!-- Users Section -->
        <h2>All Users</h2>
        <form action = "adduser.php" method="POST">
            <button class = "add-button" >Add User</button>
            </form>
        <table id="usersTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch all users from the database
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($user = $result->fetch_assoc()) {
                        if($user['id'] == 42069)
                        continue;
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($user['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                        echo "<td><div><button onclick='deleteuser(this,".$user['id'].")' class='btn btn-sm btn-danger'>Delete</button> <button onclick='edituser(\"".$user['username']."\",\"".$user['email']."\",\"".$user['id']."\")' class='btn btn-sm btn-primary'>Edit</button></div></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="table-section">
        <!-- Books Section -->
        <h2>All Books</h2>
        <form action = "addbook.php" method="POST">
            <button type = "submit" class = "add-button" >Add Book</button>
            </form>
        <table id="booksTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Year</th>
                    <th>Owner</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch all books from the database
                $sql = "SELECT * FROM books";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($book = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($book['ISBN']) . "</td>";
                        echo "<td>" . htmlspecialchars($book['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($book['author']) . "</td>";
                        echo "<td>" . htmlspecialchars($book['genre']) . "</td>";
                        echo "<td>" . htmlspecialchars($book['year']) . "</td>";
                        echo "<td>" . htmlspecialchars($book['user_id']) . "</td>";
                        echo "<td><div><button onclick=deletebook(this,".$book['ISBN'].") class='btn btn-sm btn-danger'>Delete</button> <button onclick='editbook(\"".$book['ISBN']."\",\"".$book['title']."\",\"".$book['author']."\",\"".$book['genre']."\",\"".$book['year']."\",\"".$book['user_id']."\")' class='btn btn-sm btn-primary'>Edit</button></div></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No books found.</td></tr>";
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
        $('#usersTable').DataTable({
            "paging": true,
            "pageLength": 5,
            "lengthChange": false,
            "info": false
        });

        $('#booksTable').DataTable({
            "paging": true,
            "pageLength": 5,
            "lengthChange": false,
            "info": false
        });
    });
</script>
</body>
</html>

<?php
include_once 'footer.php';
?>
