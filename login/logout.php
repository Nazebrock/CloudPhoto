<?php

session_start();
include("../php/connection.php");
$req = "INSERT INTO log (type, userid) "
                . "VALUES (2, ".$_SESSION['userId'].")";
$sql = mysqli_query($bdd, $req) or die(mysql_error());
session_unset();
session_destroy();

setcookie("path", $_SERVER['REQUEST_REFERER'], time()+120, "/");
header('Location: ../page/login.php');

?>