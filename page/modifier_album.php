<?php
session_start();
if (!isset($_SESSION['prenom'])) {
    setcookie("path", $_SERVER['REQUEST_URI'], time() + 120, "/");
    header('Location: login.php');
}
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
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron text-center">
                    <h2>Bienvenue sur le cloud Photo des LORRAIN !</h1>
                        <h3>Stat:</h3>
                </div>
            </div>
        </div>
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
                        modifier_album($albumid);
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
                            <button type="submit" class="btn btn-default">Modifier</button>
                        </div>
                    </form>

                </div>

            </div> 
        </div>
    </div>
</div>

</body>
</html>
