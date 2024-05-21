<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="functions.js" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style>
        /* Custom CSS to control the width of the table */
        #booksTable {
            width: 100%; /* Adjust as needed */
            margin: 50px;
        }
    </style>
</head>
<body>
    <header class = "header-container">
        <?php
            if (isset($_SESSION['id'])) {
               echo' <form action="logout.php" method="post">';
                 echo   '<button type="submit" class="logout-button">Logout</button>';
               echo' </form>';
            }
        ?>
        <h1>Welcome to My Website</h1>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
