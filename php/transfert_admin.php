<?php

function ajout_utilisateur(){
    $prenom = $_POST['prenom'];
    $login = $_POST['login'];
    $email = "";
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }
    include("connection.php");
    $req = "INSERT INTO UTILISATEUR(login, prenom, pass, email)"
            . "VALUES ('".$login."', '".$prenom."', '".$login."', '".$email."')";
    $sql = mysqli_query($bdd, $req) or die(mysqli_error());
    header('Refresh:0');
}

?>