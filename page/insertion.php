<?php
include('../login/verifauth.php');
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}
if ($id == 1) {
    $corp = '../part/selection_album.php';
    $progression = 0;
    $I = 'text-primary';
    $II = 'text-default';
    $III = 'text-default';
}
if ($id == 2) {
    $albumId = intval($_GET['album']);
    $corp = '../part/envoi_image.php';
    $progression = 40;
    $I = 'text-default';
    $II = 'text-primary';
    $III = 'text-default';
}
if ($id == 3) {
    $img = strval($_GET['img']);
    $corp = '../part/info_image.php';
    $progression = 75;
    $I = 'text-default';
    $II = 'text-default';
    $III = 'text-primary';
}
?>

<!DOCTYPE html>
<html>
    <?php include("../part/import.php") ?>

    <?php include("../part/layout.php") ?>

    <?php
    include ("../php/transfert.php");
    if (isset($_POST['favoris'])) {
        favoris();
    } else if (isset($_POST['selection'])) {
        ajouter_personne();
    }
    ?>
    <body>
        <div class="page-wrapper">
            <?php include("../part/bandeau.php") ?>
            <div class="row">
                <div class="col-lg-offset-2">
                    <div class="col-lg-3">
                        <h3 class=<?php echo $I ?>>I) Selection Album</h3>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h3 class=<?php echo $II ?>>II) Envoi d'image(s)</h3>
                </div>
                <div class="col-lg-3">
                    <h3 class=<?php echo $III ?>>III) Informations complémentaires <small>*Facultatif</small></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-1">
                    <div class="col-sm-10 progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progression ?>%;">
                            <span class="sr-only">60% Complete</span>
                        </div>
                    </div>
                </div>
            </div>

            <?php include($corp); ?>
        </div>

    </body>
</html>
