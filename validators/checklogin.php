<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once '../.env/db.php';

    $username = trim(htmlspecialchars($_POST['username'])) ;
    $password = trim(htmlspecialchars($_POST['password']));
    $salt = $_POST['salt'];

    $password.=$salt;

    $password = md5($password);

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1)
    {
        session_start();
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        $_SESSION["id"] = $user_id;
    }
    else
    {
        echo "Invalid username or password. Please try again.";
    }


}
else
{
    header("Location: ../error.php");
}
?>