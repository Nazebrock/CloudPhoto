<?php

include("auth.php");
/* Adresse IP du visiteur de notre page Web */
$REMOTE_ADDR = getenv("REMOTE_ADDR");

/* On enregistre nos variables de la session */
session_register("login");
session_register("pass");
session_register("id_session");
session_register("adresse_ip");

function filtre($valeur) {
    return ereg("^[a-zA-Z0-9]+$", $valeur);
}

function login() {
    global $serveur, $loginsql, $passsql, $table, $base, $log, $pwd, $erreur;
    $login = $log;
    $password = $pwd;
    if (!$login) {
        $erreur = "Erreur le champs du Login est vide";
        return false;
    }
    if (!filtre($login)) {
        $erreur = "Erreur le Login doit contenir seulement des chiffres ou des lettres";
        return false;
    }
    if (!$password) {
        $erreur = "Erreur le champs du Mot de Passe est vide";
        return false;
    }
    if (!filtre($password)) {
        $erreur = "Erreur le Mot de Passe doit contenir seulement des chiffres ou des lettres";
        return false;
    }
// Connexion au serveur

    $id = @mysql_connect($serveur, $loginsql, $passsql) or die("Impossible de se connecter à la base de donnée");
    @mysql_select_db("$base") or die("<br>Impossible de séléctionner la base: $base<br>" . mysql_error());
// Sélection de la table
    $Requete = " SELECT login, pass ";
    $Requete.= " FROM $table ";
    $Requete.= " WHERE login = '$login' AND pass = '$password' ";
    $result = mysql_query($Requete, $id) or die("Requete de vérification de Login et Mot de Passe invalide: " . mysql_error());
// retoune le nombre d'enregistrements dans la table ( ligne )
    $lignes = mysql_num_rows($result);
    if ($lignes < 1) {
        $erreur = "Erreur Login ou Mot de Passe incorrect";
        $pwd = "";
        return false;
    } else {
        $res = mysql_fetch_row($result);
        if ($res[0] == $login && $res[1] == $password) {
            return true;
        } else {
            $erreur = "Erreur Login ou Mot de Passe incorrect";
            $pwd = "";
            return false;
        }
    }
}

if (!login()) {
    session_destroy();
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date du passé
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // toute le temps différente
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // HTTP/1.0
    include($index);
    exit();
} else {
    $login = $log;
    $pass = $pwd;
    $id_session = session_id();
    $adresse_ip = $REMOTE_ADDR;
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date du passé
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // toute le temps différente
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // HTTP/1.0
    include($index);
}
?>