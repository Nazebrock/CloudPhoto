<?php

function verifauth() {
    $nom = $_POST['nom'];
    $passwd = $_POST['mdp'];

    include("../php/connection.php");
    $control = False;
    $reqcontrol = "SELECT login, etat FROM UTILISATEUR";
    $sql = mysqli_query($bdd, $reqcontrol) or die(mysql_error());
    while ($col = mysqli_fetch_row($sql)) {
        if ($col[0] == $nom && $col[1] == 1) {
            $control = True;
        }
    }
    if ($control == False) {
        return 0;
    }

    mysqli_free_result($sql);

    $req = "SELECT pass, prenom, UserId FROM UTILISATEUR WHERE " .
            "login = '" . $nom . "'";
    $sql = mysqli_query($bdd, $req) or die(mysql_error());
    $col = mysqli_fetch_row($sql);

    if ($col[0] == $passwd) {
        session_name($nom);
        session_start();
        $req = "INSERT INTO LOG (type, userid) "
                . "VALUES (1, ".$col[2].")";
        $sql = mysqli_query($bdd, $req) or die(mysql_error());
        $_SESSION['prenom'] = $col[1];
        $_SESSION['userId'] = $col[2];
        if (isset($_COOKIE['path'])) {
            $path = $_COOKIE['path'];
            setcookie("path", NULL, -1);
        } else {
            $path = "/CloudPhoto/";
        }
        header('location: ' . $path);
    } else {
        echo "ko";
    }
}

?>