<?php

/* Adresse IP du visiteur de notre page Web */
$REMOTE_ADDR = getenv("REMOTE_ADDR");

/* Fonction de filtre des caractères */

function filtrelog($valeur) {
    return ereg("^[a-zA-Z0-9]+$", $valeur);
}

/* Fonction de vérification du login et du mot de passe dans la base de données */

function veriflog() {
    global $serveur, $loginsql, $passsql, $table, $base, $login, $pass;
    $password = $pass;
    if (!$login) {
        return false;
    }
    if (!filtrelog($login)) {
        return false;
    }
    if (!$password) {
        return false;
    }
    if (!filtrelog($password)) {
        return false;
    }
// Connexion au serveur
    include("../php/connection.php");
// Sélection de la table
    $Requete = " SELECT login, pass ";
    $Requete.= " FROM $table ";
    $Requete.= " WHERE login = '$login' AND pass = '$password' ";
    $result = mysqli_query($Requete, $id) or die("Requete invalide");
// retoune le nombre d'enregistrements dans la table ( ligne )
    $lignes = mysqli_num_rows($result);
    if ($lignes < 1)
        return false;
    else {
        $res = mysqli_fetch_row($result);
        if ($res[0] == $login && $res[1] == $password)
            return true;
        else
            return false;
    }
}

if ($login != "" && $pass != "" && $id_session != "" && $adresse_ip == $REMOTE_ADDR) {
    if (!(veriflog())) {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date du passé
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // toute le temps différente
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Pragma: no-cache");
        $erreur = "Erreur Login ou Mot de Passe incorrect";
        include($index);
        exit();
    }
} else {
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date du passé
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // toute le temps différente
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache");
    $erreur = "Erreur Login ou Mot de Passe incorrect";
    include($index);
    exit();
}
?>