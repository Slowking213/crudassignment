<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    session_destroy();
    header("Location: login.php");
}
else
{
    header("Location: error.php");
}

?>