<?php


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    include '../.env/db.php';
    $id = $_POST['id'];
    $name = $_POST['username'];
    $email = $_POST['email'];
    $sql = "UPDATE users SET username='$name', email='$email' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
else
{
    header("Location: ../error.php");
}


?>