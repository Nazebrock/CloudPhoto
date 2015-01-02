<?php
include('../login/verifauth.php');
if ($_SESSION['userId'] == 1) {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        include("../php/connection.php");
        $req = "DELETE FROM news "
                . "WHERE id=" . $id;
        $sql = mysqli_query($bdd, $req) or die(mysql_error());

        header('Location: ../index.php');
    } else {
        header('Location: ../index.php');
    }
}
?>