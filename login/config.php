<?php

/* Nom de la session */
$sessname = "loginphp";
/* Page d'accueil */
$index = "index.php";
/* Page d'accueil pour les loggés */
$indexlog = "indexlog.php";
/* Page pour se logguer */
$veriflogin = "login.php";
/* Page pour se délogguer */
$logout = "logout.php";


/*
  On récupère nos variables d'environnement dont on va se servir,
  car celles-ci ne sont pas toujours initialisées automatiquement
 */
$HTTP_HOST = getenv("HTTP_HOST"); /* Nom de domaine du serveur qui éxecute le PHP */
$REMOTE_ADDR = getenv("REMOTE_ADDR"); /* Adresse IP du visiteur de notre page Web */
$HTTP_USER_AGENT = getenv("HTTP_USER_AGENT"); /* Navigateur du visiteur */

/* On vérifie si on est en local ou sur Internet pour pouvoir tester le programme en local */
if ($HTTP_HOST != "localhost") {
    $serveur = "mysql.free.fr";
    $loginsql = "monlogin";
    $passsql = "monmotdepass";
} else {
    $serveur = "localhost"; /* Mode local ne nécessite ni mot de pass ni login */
    $loginsql = "";
    $passsql = "";
    /* Chemin de sauvegarde de nos sessions */
    $save_path = '../tmp';
    session_save_path($save_path);
    $save_path = session_save_path();
}

$base = "cloud-photo"; // Nom de la base
$table = "utilisateur"; // Table des inscriptions
?>