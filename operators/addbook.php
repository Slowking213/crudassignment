<?php

require_once('../.env/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    $title = trim(htmlspecialchars($_POST['title'])) ;
    $author = trim(htmlspecialchars($_POST['author']));
    $genre = trim(htmlspecialchars($_POST['genre']));
    $year = trim(htmlspecialchars($_POST['year']));
    $isbn = trim(htmlspecialchars($_POST['isbn']));
    session_start();
    $user_id = $_POST['user_id'];

    $query = "SELECT * FROM books WHERE isbn = '$isbn'";

    $result = $conn->query($query);

    if($result->num_rows > 0)
    {
        echo "Book already exists.";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO books (title, author, genre, year, isbn,user_id) VALUES (?, ?, ?, ?, ?,?)");
    $stmt->bind_param("ssssss", $title, $author, $genre, $year, $isbn,$user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "success";
}
else
{
    header("Location: error.php");
}


?>