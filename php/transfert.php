<?php

function transfert($albumId) {
    $taille = count($_FILES['fic']['name']);
    $uploaded_img = '';
    for ($i = 0; $i < $taille; $i++) {

        $img_taille = $_FILES['fic']['size'][$i];
        $img_type = $_FILES['fic']['type'][$i]; //récupere le type
        $img_nom = $_FILES['fic']['name'][$i]; //recupere le nom
        $img_blob = file_get_contents($_FILES['fic']['tmp_name'][$i]);

        if(isset($img_type) && isset($img_taille) && isset($img_blob)){
            if($img_taille > 10000000){
                echo "Image trop lourde (Taille max: 10Mo)";
                return 0;
            }
            elseif($img_type != "image/jpeg" && $img_type != "image/gif" && $img_type != "image/png" && $img_type != "image/tiff"){
                echo "Format d'image non supporté (Format supporté: jpeg, png, gif, tiff)";
                return 0;
            }
        }
        else{
            echo "erreur";
            return 0;
        }
        include ("connection.php");

//on insert l'image
        $sqlImage = "INSERT INTO image (" .
                "img_nom, img_taille, img_type, img_blob" .
                ") VALUES (" .
                "'" . $img_nom . "', " .
                "'" . $img_taille . "', " .
                "'" . $img_type . "', " .
                "'" . addslashes($img_blob) . "') ";
        $reqImage = mysqli_query($bdd, $sqlImage) or die(mysql_error());


//on recupere son id 
        $sql = "SELECT MAX(img_id) " .
                "FROM image WHERE img_nom = '" . $img_nom . "'";

        $req = mysqli_query($bdd, $sql) or die(mysql_error());
        $image = mysqli_fetch_row($req);
        mysqli_free_result($req);

//on recupere les info lié a l'album 
        $sql = "SELECT Tag_date, Tag_lieu, Tag_event " .
                "FROM album WHERE albumid = '" . $albumId . "'";

        $req = mysqli_query($bdd, $sql) or die(mysql_error());
        $album = mysqli_fetch_row($req);
        mysqli_free_result($req);

        if ($img_type == 'image/jpeg') {
            $stat = exif_read_data($_FILES['fic']['tmp_name'][$i]);
            if (isset($stat['DateTimeOriginal'])) {
//recuperation de la date a laquelle a été prise la photo
                $date_original = $stat['DateTimeOriginal'];
            } else {
                $date_original = $album[0];
            }
        } else {
            $date_original = $album[0];
        }

//on insert des info supplémentaire sur l'image associé à son ID
        $sqltag = "INSERT INTO tag (" .
                "img_Id, UserId, Tag_personne, Tag_date, Tag_lieu, Tag_event, Tag_albumId" .
                ") VALUES (" .
                "'" . $image[0] . "', " .
                "'" . $_SESSION['userId'] . "', " .
                "'0', " .
                "'" . $date_original . "', " .
                "'" . $album[1] . "', " .
                "'" . $album[2] . "', " .
                "'" . $albumId . "') ";
        $reqtag = mysqli_query($bdd, $sqltag) or die(mysql_error());

        $uploaded_img = $uploaded_img . '.' . $image[0];
//Log
        $sql = "INSERT INTO log (type, info, userid) " .
                "VALUES (5, " . $image[0] . ", " . $_SESSION['userId'] . ")";
        $req = mysqli_query($bdd, $sql) or die(mysql_error());
    }
    mysqli_close($bdd);
    //header('Location: ../page/insertion.php?id=3&img=' . $uploaded_img);
    echo '<script>document.location.replace("../page/insertion.php?id=3&img=' . $uploaded_img . '")</script>';
}

function creer_album() {

    $nom = $_POST['nom'];
    $lieu = $_POST['lieu'];
    $event = $_POST['event'];
    $date = $_POST['date'];

    if ($nom == '') {
        echo "<div class=\"alert alert-warning\" role=\"alert\">L'album doit avoir un nom !</div>";
        return 0;
    }

    include ("connection.php");
    $req = "SELECT nom FROM album";
    $sql = mysqli_query($bdd, $req);
    while($col = mysqli_fetch_row($sql)){
        if($nom == $col[0]){
            echo "<div class=\"alert alert-warning\" role=\"alert\">Nom d'album déjà utilisé !</div>";
            return 0;
        }
    }
    mysqli_free_result($sql);
    
    $sqlalbum = "INSERT INTO album (" .
            "createurid, nom, Tag_date, Tag_lieu, Tag_event" .
            ") VALUES (" .
            "'" . $_SESSION['userId'] . "', " .
            "'" . $nom . "', " .
            "'" . $date . "', " .
            "'" . $lieu . "', " .
            "'" . $event . "') ";
    $reqalbum = mysqli_query($bdd, $sqlalbum) or die(mysql_error());

//on recupere son id 
    $sql = "SELECT albumid " .
            "FROM album WHERE nom = '" . $nom . "'";

    $req = mysqli_query($bdd, $sql) or die(mysql_error());
    $col = mysqli_fetch_row($req);
    mysqli_free_result($req);

    //Log
    include("../php/connection.php");
    $sql = "INSERT INTO log (type, info, userid) " .
            "VALUES (3, " . $col[0] . ", " . $_SESSION['userId'] . ")";
    $req = mysqli_query($bdd, $sql) or die(mysql_error());

    //header('Location: ../page/insertion.php?id=2&album=' . $col[0]);
    echo '<script>document.location.replace("../page/insertion.php?id=2&album=' . $col[0] . '")</script>';
}

function modifier_album($albumid) {
    $nom = $_POST['nom'];
    $lieu = $_POST['lieu'];
    $event = $_POST['event'];
    $date = $_POST['date'];

    if ($nom == '') {
        echo "<div class=\"alert alert-warning\" role=\"alert\">L'album doit avoir un nom !</div>";
        return 0;
    }

    include ("connection.php");
    
    $req = "SELECT nom FROM album WHERE albumid !=".$albumid;
    $sql = mysqli_query($bdd, $req);
    while($col = mysqli_fetch_row($sql)){
        if($nom == $col[0]){
            echo "<div class=\"alert alert-warning\" role=\"alert\">Nom d'album déjà utilisé !</div>";
            return 0;
        }
    }
    mysqli_free_result($sql);

    $sqlalbum = "UPDATE album " .
            "SET nom = '" . $nom . "', tag_date = '" . $date . "', tag_lieu = '" . $lieu . "', tag_event = '" . $event . "'" .
            "WHERE albumid = " . $albumid;
    $reqalbum = mysqli_query($bdd, $sqlalbum) or die(mysql_error());

    header('Location: ../page/afficher.php?id=1&album=' . $albumid);
}

function ajouter_personne() {
    $contenu = $_POST['selection'];
    $contenu = explode('!', $contenu);
    $personne = $contenu[1];
    $id = $contenu[0];

    $personnes = explode(',', $personne);
    $nbr_personnes = count($personnes) - 1;
    include ("connection.php");
    $sqlperso = "UPDATE tag " .
            "SET Tag_personne = '" . $personne . "', nbr_personne = " . $nbr_personnes . " WHERE img_id = " . $id;
    $reqperso = mysqli_query($bdd, $sqlperso) or die(mysql_error());

    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    //header('Location : ' . $url);
    //echo '<script>document.location.replace("' . $url . '")</script>';
}

function favoris() {
    $contenu = $_POST['favoris'];
    $contenu = explode(',', $contenu);
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    include ("connection.php");
    if ($contenu[0] == 1) {
        $req = "INSERT INTO favoris(" .
                "UserId, imgId)" .
                " VALUES (" . $contenu[1] . ", " . $contenu[2] . ")";
        $sql = mysqli_query($bdd, $req) or die(mysql_error());
    } else if ($contenu[0] == 0) {
        $req = "DELETE FROM favoris " .
                "WHERE UserId = " . $contenu[1] . " AND imgId = " . $contenu[2];
        $sql = mysqli_query($bdd, $req) or die(mysql_error());
    }
    //header('Location : ' . $url);
    echo '<script>document.location.replace("' . $url . '")</script>';
}

function supprimer_photo($userid){
    
    $id = $_POST['suppr_id'];
    
    include ("connection.php");
    $req = "DELETE FROM favoris WHERE imgid=".$id." AND userid =".$userid;
    $sql = mysqli_query($bdd, $req) or die(mysql_error());
    $req = "DELETE FROM image WHERE img_id=".$id;
    $sql = mysqli_query($bdd, $req) or die(mysql_error());
    $req = "DELETE FROM tag WHERE img_id=".$id;
    $sql = mysqli_query($bdd, $req) or die(mysql_error());
    
    //log
    $sql = "INSERT INTO log (type, info, userid) " .
                "VALUES (6, " . $id . ", " . $userid . ")";
    $req = mysqli_query($bdd, $sql) or die(mysql_error());
    
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
     echo '<script>document.location.replace("' . $url . '")</script>';
}

?>
