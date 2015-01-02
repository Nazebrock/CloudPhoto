<div class="row">
    <div class="col-lg-offset-1">
        <div class="col-lg-9">
            <?php
            include ("../php/connection.php");
            $req = "SELECT createurId, nom, DATE_FORMAT(tag_date, '%d/%m/%Y'), tag_lieu, tag_event " .
                    "FROM album WHERE albumid = " . $albumId;
            $ret = mysqli_query($bdd, $req) or die(mysql_error());
            $album = mysqli_fetch_row($ret);
            mysqli_free_result($ret);
            echo "<div class=\"page-header\"><h1>" . $album[1] . "<small> | " . $album[4] . " à " . $album[3] . " le " . $album[2] . "</small>";
            if ($album[0] == $_SESSION['userId'] || $_SESSION['userId'] == 1) {
                echo "<a href=\"modifier_album.php?id=" . $albumId . "\"class=\"btn btn-default btn-sm\"><span class=\"glyphicon glyphicon-cog\"></span></a></h1></div>";
            }
            ?>

        </div>
    </div>
</div>
<?php
//recupere les favoris
$favoris = "False";
$req = "SELECT imgID FROM favoris WHERE UserID = '" . $_SESSION['userId'] . "' AND imgID IN " .
        "(SELECT imgID FROM tag WHERE Tag_albumId = '" . $albumId . "')";
$ret = mysqli_query($bdd, $req) or die(mysql_error());
$fav = array();
while ($col = mysqli_fetch_array($ret)) {
    $fav[] = $col[0];
}
mysqli_free_result($ret);

//on recupere le nombre de photo à afficher
$req = "SELECT count(img_id) FROM tag WHERE tag_albumid = " . $albumId;
$ret = mysqli_query($bdd, $req) or die(mysql_error());
$nbr = mysqli_fetch_row($ret);
mysqli_free_result($ret);


//recupere les images de l'album
$req = "SELECT img_id, tag_personne, DATE_FORMAT(tag_date, '%d%m%Y%H%i%s') FROM tag WHERE tag_albumid = " . $albumId;
$ret = mysqli_query($bdd, $req) or die(mysql_error());
$img = array();
$i = 0;
while ($col = mysqli_fetch_row($ret)) {
    $img[$i][0] = $col[0];
    $img[$i][1] = $col[1];
    $img[$i][2] = $col[2];
    $img[$i][3] = $album[1];
    $i++;
}
mysqli_free_result($ret);
?>



