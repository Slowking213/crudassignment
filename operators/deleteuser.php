<?php


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../.env/db.php';
    session_start();
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
else
{
    header("Location: ../error.php");
}


?>