<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $salt = "3P0K4!@##@!_7!r4n3";
    echo $salt;
}
else
{
    header("Location: ../error.php");
}

?>