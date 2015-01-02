<?php
include('../php/connection.php');
//nombre d'album
    $req = "SELECT count(albumId) FROM album";
    $ret = mysqli_query($bdd, $req) or die(mysql_error());
    $nbr_album = mysqli_fetch_row($ret);
    mysqli_free_result($ret);
//nombre d'image
    $req = "SELECT count(img_Id) FROM image";
    $ret = mysqli_query($bdd, $req) or die(mysql_error());
    $nbr_img = mysqli_fetch_row($ret);
    mysqli_free_result($ret);
//nombre d'image où personne est taggé
    $req = "SELECT count(img_Id) FROM tag WHERE nbr_personne = 0";
    $ret = mysqli_query($bdd, $req) or die(mysql_error());
    $nbr_img_empty = mysqli_fetch_row($ret);
    mysqli_free_result($ret);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron text-center">
            <h2>Bienvenue sur le cloud Photo des LORRAIN !</h2>
            <h3>Stat: <?php echo $nbr_img[0] ?> images dans <?php echo $nbr_album[0] ?> Albums</h3>
            <h4 class="text-danger"><a href="afficher.php?id=4"> <?php echo $nbr_img_empty[0] ?> images</a> où personne n'est taggé !</h4>
        </div>
    </div>
</div>