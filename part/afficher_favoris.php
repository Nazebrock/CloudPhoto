<?php
include ("../php/connection.php");
//on recupere le nombre de photo à afficher
$req = "SELECT count(img_id) FROM tag, album WHERE "
        . "tag.tag_albumId = album.albumId AND "
        . "img_id IN (SELECT imgId FROM favoris WHERE userId = " . $_SESSION['userId'] . ")";
$ret = mysqli_query($bdd, $req) or die(mysql_error());
$nbr = mysqli_fetch_row($ret);
mysqli_free_result($ret);

//recupere les image des favoris
$req = "SELECT tag.img_id, tag.tag_personne, DATE_FORMAT(tag.tag_date, '%d%m%Y%H%i%s'), album.nom, tag.userid FROM tag, album WHERE "
        . "tag.tag_albumId = album.albumId AND "
        . "img_id IN (SELECT imgId FROM favoris WHERE userId = " . $_SESSION['userId'] . ")";
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
    $img[$i][4] = $col[4];
    $i++;
}
mysqli_free_result($ret);
?>
<div class="row">
    <div class="col-lg-offset-1">
        <div class="col-lg-9">
            <div class="page-header"><h1>Mes favoris
            <?php
            echo " <a href=\"diapo.php?id=";
            foreach ($img as $image) {
                echo $image[0] . ".";
            }
            echo '"class="btn btn-default btn-sm"><span class="glyphicon glyphicon-picture"></span></a></h1></div>';
            ?>
        </div>
    </div>

</div>