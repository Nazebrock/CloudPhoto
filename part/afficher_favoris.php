<div class="row">
    <div class="col-lg-offset-1">
        <div class="col-lg-9">
            <div class="page-header"><h1>Mes favoris</h1></div>
        </div>
    </div>

</div>


<?php
include ("../php/connection.php");
//on recupere le nombre de photo à afficher
$req = "SELECT count(img_id) FROM TAG, ALBUM WHERE "
        . "TAG.tag_albumId = ALBUM.albumId AND "
        . "img_id IN (SELECT imgId FROM FAVORIS WHERE userId = " . $_SESSION['userId'] . ")";
$ret = mysqli_query($bdd, $req) or die(mysql_error());
$nbr = mysqli_fetch_row($ret);
mysqli_free_result($ret);

//recupere les image des favoris
$req = "SELECT TAG.img_id, TAG.tag_personne, DATE_FORMAT(TAG.tag_date, '%d%m%Y%H%i%s'), ALBUM.nom FROM TAG, ALBUM WHERE "
        . "TAG.tag_albumId = ALBUM.albumId AND "
        . "img_id IN (SELECT imgId FROM FAVORIS WHERE userId = " . $_SESSION['userId'] . ")";
$ret = mysqli_query($bdd, $req) or die(mysql_error());
$img = array();
$fav = array();
$i = 0;
while ($col = mysqli_fetch_row($ret)) {
    $fav[] = $col[0];
    $img[$i][0] = $col[0];
    $img[$i][1] = $col[1];
    $img[$i][2] = $col[2];
    $img[$i][3] = $col[1];
    $i++;
}
mysqli_free_result($ret);
?>


