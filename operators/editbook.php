<?php

require_once('../.env/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    $title = trim(htmlspecialchars($_POST['title'])) ;
    $author = trim(htmlspecialchars($_POST['author']));
    $genre = trim(htmlspecialchars($_POST['genre']));
    $year = trim(htmlspecialchars($_POST['year']));
    $isbn = trim(htmlspecialchars($_POST['ISBN']));
    $id = $_POST['id'];
    session_start();
    $user_id = $_POST['user_id'];

    $query = "SELECT * FROM books WHERE isbn = '$isbn'";

    $result = $conn->query($query);

    if($result->num_rows > 0)
    {
        echo "Book already exists.";
        exit();
    }

   //update book

    $stmt = $conn->prepare("UPDATE books SET title = ?, author = ?, genre = ?, year = ?, isbn = ?, user_id = ? WHERE isbn = ?");
    $stmt->bind_param("sssssss", $title, $author, $genre, $year, $isbn, $user_id, $id);
    $stmt->execute();
    $result = $stmt->get_result();


    header("Location: ../admin.php");
}
else
{
    header("Location: error.php");
}


?>