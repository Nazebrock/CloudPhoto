<?php
include('../login/verifauth.php');
?>
<?php
if (isset($_GET['id'])) {
    $albumid = intval($_GET['id']);
}
?>
<!DOCTYPE html>
<html>

    <?php include("../part/import.php") ?>

    <?php include("../part/layout.php") ?>
    <div class="page-wrapper">
        <?php include("../part/bandeau.php") ?>
        <div class="row">
            <div class="col-lg-offset-4">
                <div class="col-lg-6">                
                    <?php
                    include ("../php/connection.php");
                    $req = "SELECT nom, tag_date, tag_lieu, tag_event " .
                            "FROM album WHERE albumid = " . $albumid;
                    $ret = mysqli_query($bdd, $req) or die(mysql_error());
                    $info_album = mysqli_fetch_row($ret);
                    mysqli_free_result($ret);

                    include ("../php/transfert.php");
                    if (isset($_POST['nom'])) {
                        if (isset($_POST['modifier'])) {
                            modifier_album($albumid);
                        } elseif (isset($_POST['supprimer'])) {
                            //Log
                            include("../php/connection.php");
                            $sql = "INSERT INTO log (type, info, userid) " .
                                    "VALUES (4, " . $albumid . ", " . $_SESSION['userId'] . ")";
                            $req = mysqli_query($bdd, $sql) or die(mysql_error());
                            //Suppression
                            $req = "DELETE FROM favoris WHERE "
                                    . "imgId IN "
                                    . "(SELECT img_ID FROM tag WHERE Tag_albumId = " . $albumid . ")";
                            $ret = mysqli_query($bdd, $req) or die(mysql_error());
                            $req = "DELETE FROM image WHERE "
                                    . "img_Id IN "
                                    . "(SELECT img_ID FROM tag WHERE Tag_albumId = " . $albumid . ")";
                            $ret = mysqli_query($bdd, $req) or die(mysql_error());
                            $req = "DELETE FROM album WHERE "
                                    . "AlbumId = " . $albumid;
                            $ret = mysqli_query($bdd, $req) or die(mysql_error());
                        }
                    }
                    ?>
                    <div class="page-header">
                        <h1>Modification d'Album<small> | <?php echo $info_album[0] ?></small></h1>
                    </div>
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" action="#" method="post">
                        <div class="form-group has-warning">
                            <label for="nom" class="col-sm-2 control-label">Nom</label>
                            <div class="col-sm-5">
                                <input class="form-control" name="nom" id="nom" value="<?php echo $info_album[0] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lieu" class="col-sm-2 control-label">lieu</label>
                            <div class="col-sm-5">
                                <input class="form-control" name="lieu" id="lieu" value="<?php echo $info_album[2] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event" class="col-sm-2 control-label">Evenement</label>
                            <div class="col-sm-5">
                                <input class="form-control" name="event" id="event" value="<?php echo $info_album[3] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" name="date" id="date" value="<?php echo $info_album[1] ?>">
                            </div>
                        </div>
                        <div class="col-lg-offset-2">
                            <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal">Supprimer</button>
                        </div>

                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="col-sm-offset-1">
                                            <h5>Etes-vous sûr de vouloir supprimer cet album et toutes ces photo ?</h5>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-sm-offset-5">
                                            <button type="button" class="btn btn-primary" class="close" data-dismiss="modal" aria-label="Close">Non</button>
                                            <button type="submit" name="supprimer" class="btn btn-danger">Oui</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</div>
<?php include('../part/footer.php') ?>
</body>
</html>