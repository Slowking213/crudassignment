<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    require_once '../.env/db.php';

    $username = trim(htmlspecialchars($_POST['username'])) ;
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));
    $admin = $_POST['admin'];
    $salt = $_POST['salt'];

    $password.=$salt;

    $password = md5($password);

    $quer = "SELECT id FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($quer);

    if($result->num_rows > 0)
    {
        echo "Username already exists. Please try again.";
        exit();
    }

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    $conn->query($sql);

    $quer = "SELECT id FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($quer);

    session_start();
    if(@!isset($_SESSION['id'])){
    $_SESSION["id"] = $result->fetch_assoc()['id'];
    }
    echo "success";
}
?>