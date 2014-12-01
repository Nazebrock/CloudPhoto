<?php
session_start();
if (!isset($_SESSION['prenom'])){
    setcookie("path", $_SERVER['REQUEST_URI'], time()+120, "/");
    header('Location: login.php');
}
?>
<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}
if ($id == 1) {
    $albumId = intval($_GET['album']);
    $corp = '../part/afficher_album.php';
}
if ($id == 2) {
    $recherche = strval($_GET['recherche']);
    $corp = '../part/afficher_recherche.php';
}
if ($id == 3) {
    $corp = '../part/afficher_favoris.php';
}
?>
<!DOCTYPE html>
<html>
    <script src="../Bootstrap/js/blur.min.js.js"></script>

    <?php include("../part/import.php") ?>

    <?php include("../part/layout.php") ?>
    <!-- 
        Inserer un Carousel et un thumbnails
    -->
    <div class="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron text-center">
                    <h2>Bienvenue sur le cloud Photo des LORRAIN !</h1>
                        <h3>Stat:</h3>
                </div>
            </div>
        </div>
        
        <?php include($corp); ?>
        
    </body>
</html>
<?php
/*
  include ("../php/connection.php");
  $req = "SELECT img_nom, img_id " .
  "FROM image ORDER BY img_id";
  $ret = mysqli_query($bdd, $req) or die(mysql_error());
  while ($col = mysqli_fetch_row($ret)) {
  echo "<a href=\"php/apercu.php?id=" . $col[1] . "\">" . $col[0] . "</a><br />";
  echo "<div class=\"col-xs-2 col-md-2\"><a href=\"#\" class=\"thumbnail\"><img src=\"../php/thumbnail.php?id=" . $col[1] . "\"></a></div>";
  } */
?>