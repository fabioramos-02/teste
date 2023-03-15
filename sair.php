<?php
session_start();
unset(
    $_SESSION['id'],
    $_SESSION['username'] ,
    $_SESSION['password']
);
//redireciona para login
header("location: login.php");
?>