<?php

session_start();
session_unset();
session_destroy();

setcookie("path", $_SERVER['REQUEST_REFERER'], time()+120, "/");
header('Location: ../page/login.php');

?>