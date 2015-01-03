<?php
include('../login/verifauth.php');
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
if ($id == 4) {
    $corp = '../part/afficher_notag.php';
}
?>
<!DOCTYPE html>
<html>
    <?php include("../part/import.php") ?>

    <?php include("../part/layout.php") ?>
    <div class="page-wrapper">

        <?php include("../part/bandeau.php") ?>
        <?php include($corp); ?>
        <?php
        include ("../php/transfert.php");
        if (isset($_POST['favoris'])) {
            favoris();
        } else if (isset($_POST['selection'])) {
            ajouter_personne();
        } else if (isset($_POST['supprimer'])) {
            supprimer_photo($_SESSION['userId']);
        }
        ?>
        <div class="row">
            <div class="col-lg-offset-1">
                <div class="col-lg-10">
                    <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-pills" role="tablist">
                            <?php
                            for ($i = 1; $i <= ($nbr[0] / 48) + 1; $i++) {
                                if ($i == 1) {
                                    echo '<li role="presentation" class="active"><a href="#' . $i . '" aria-controls="' . $i . '" role="tab" data-toggle="tab">' . $i . '</a></li>';
                                } else {
                                    echo '<li role="presentation" ><a href="#' . $i . '" aria-controls="' . $i . '" role="tab" data-toggle="tab">' . $i . '</a></li>';
                                }
                            }
                            ?>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?php
                            $cpt = 1;
                            $i = 1;
                            foreach ($img as $image) {
                                if ($cpt == 1) {
                                    echo '<div role="tabpanel" class="tab-pane active" id="' . $i . '">'; //met le premier tabpanel actif
                                    $i++;
                                } else if ($cpt % 49 == 0) {
                                    echo '<div role="tabpanel" class="tab-pane" id="' . $i . '">'; //sinon met simplement un tabpanel
                                    $i++;
                                }
                                $favoris = "False";
                                foreach ($fav as $id) {
                                    if ($image[0] == $id) {
                                        //L'image fais partie des favoris de l'utilisateur
                                        $favoris = "True";
                                    }
                                }
                                echo '<div class="col-xs-2 col-md-2">'
                                . '<button type="button" onclick="modal(\'' . $image[0] . '\', \'' . $image[1] . '\', \'' . $image[2] . '\',\'' . $image[3] . '\', \'' . $favoris . '\', \'' . $_SESSION['userId'] . '\', \'' . $image[4] . '\');" '
                                . 'data-toggle="modal" data-target="#myModal" class="thumbnail">'
                                . '<img src="../php/thumbnail.php?id=' . $image[0] . '&size=200">'
                                . '</button>'
                                . '</div>';
                                if ($cpt % 48 == 0) {
                                    echo '</div>';
                                }
                                $cpt++;
                            }
                            ?>

                        </div>
                    </div>
                    <!-- Modal Photo -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <div class="close"id="btn_close"></div>
                                    <h4 class="modal-title" id="myModalLabel"></h4>
                                </div>
                                <div class="modal-body thumbnail">
                                    <img id="modal-image" src="">
                                    <div id="personne" ></div>
                                </div>
                                <div class="modal-footer" >
                                    <div id="menu_personne"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal verification -->
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="col-sm-offset-2">
                                        <h5>Etes-vous sûr de vouloir supprimer cette Photo ?</h5>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm-offset-5">
                                        <form role="form" enctype="multipart/form-data" action="#" method="post">
                                            <button type="button" class="btn btn-primary" class="close" data-dismiss="modal" aria-label="Close">Non</button>
                                            <button type="submit" name="supprimer" class="btn btn-danger">Oui</button>
                                            <input type="hidden" name="suppr_id" id="suppr_id">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('../part/footer.php') ?>
</body>
</html>
<script src="../Bootstrap/js/tag_personne.js"></script>