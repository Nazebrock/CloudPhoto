<div class="row">
    <div class="col-lg-offset-1">
        <div class="col-lg-9">
            <div class="page-header"><h1>Photo sans Tag</h1></div>
        </div>
    </div>

</div>
<?php
include ("../php/connection.php");
//on recupere les favoris
$req = "SELECT FAVORIS.imgid FROM FAVORIS, TAG WHERE "
        . "FAVORIS.imgid = TAG.img_id AND TAG.nbr_personne = 0";
$ret = mysqli_query($bdd, $req) or die(mysql_error());
$fav = array();
while ($col = mysqli_fetch_array($ret)) {
    $fav[] = $col[0];
}
echo "1";
mysqli_free_result($ret);
//on recupere le nombre de photo à afficher
$req = "SELECT count(img_id) FROM TAG WHERE "
        . "nbr_personne = 0";
$ret = mysqli_query($bdd, $req) or die(mysql_error());
$nbr = mysqli_fetch_row($ret);
mysqli_free_result($ret);

//recupere les images sans tag
$req = "SELECT TAG.img_id, TAG.tag_personne, DATE_FORMAT(TAG.tag_date, '%d%m%Y%H%i%s'), ALBUM.nom FROM TAG, ALBUM WHERE "
        . "TAG.tag_albumId = ALBUM.albumId AND "
        . "TAG.nbr_personne = 0";
$ret = mysqli_query($bdd, $req) or die(mysql_error());
$img = array();
$i = 0;
while ($col = mysqli_fetch_row($ret)) {
    $img[$i][0] = $col[0];
    $img[$i][1] = $col[1];
    $img[$i][2] = $col[2];
    $img[$i][3] = $col[3];
    $i++;
}
mysqli_free_result($ret);
?>


