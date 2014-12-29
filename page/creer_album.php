<?php
include('../login/verifauth.php');
?>
<!DOCTYPE html>
<html>

    <?php include("../part/import.php") ?>

    <?php include("../part/layout.php") ?>

    <div class="page-wrapper">
        <?php include("../part/bandeau.php") ?>
        <div class="row">
            <div class="col-lg-offset-2">
                <div class="col-lg-3">
                    <h3 class="text-primary">I) Creation Album</h3>
                </div>
            </div>
            <div class="col-lg-3">
                <h3>II) Envoi d'image(s)</h3>
            </div>
            <div class="col-lg-3">
                <h3>III) Informations complémentaires</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-offset-1">
                <div class="col-sm-10 progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-offset-4">
                <div class="col-lg-5">                
                    <?php
                    include ("../php/transfert.php");
                    if (isset($_POST['nom'])) {
                        creer_album();
                    }
                    ?>
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" action="#" method="post">
                        <div class="form-group has-warning">
                            <label for="nom" class="col-sm-2 control-label">Nom</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="nom" id="nom" placeholder="Nom de l'album">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lieu" class="col-sm-2 control-label">lieu</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="lieu" id="lieu" placeholder="Lieu de l'album">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event" class="col-sm-2 control-label">Evenement</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="event" id="event" placeholder="Evenement de l'album">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" name="date" id="date" placeholder="Date de l'album">
                            </div>
                        </div>
                        <div class="col-lg-offset-2">
                            <button type="submit" class="btn btn-default">Creer</button>
                        </div>
                    </form>

                </div>

            </div> 
        </div>
    </div>
</div>

</body>
</html>
