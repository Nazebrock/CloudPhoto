<?php
session_start();
if (!isset($_SESSION['prenom'])){
    setcookie("path", $_SERVER['REQUEST_URI'], time()+120, "/");
    header('Location: login.php');
}
?>