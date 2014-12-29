<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <?php include("../part/import.php") ?>

    <div class="navbar navbar-inverse navbar-fixed-top">
    </div>

    <div class="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron text-center">
                    <h2>Bienvenue sur le cloud Photo des LORRAIN !</h1>
                </div>
            </div>
        </div>

        <div class="col-lg-offset-4">
            <div class="col-lg-7">
                <?php
                include ("../login/auth.php");
                if (isset($_POST['nom'])) {
                    verifauth();
                }
                ?>
                <form  class="form-horizontal"role="form" enctype="multipart/form-data" action="#" method="post">
                    <div class="form-group">
                        <label for="nom" class="col-sm-2 control-label">Nom</label>
                        <div class="col-sm-5">
                            <input class="form-control" name="nom" id="nom">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mdp" class="col-sm-2 control-label">Mot de passe</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" name="mdp" id="mdp" >
                        </div>
                    </div>
                    <div class="col-lg-offset-2">
                        <button type="submit" class="btn btn-default">login</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <?php include('../part/footer.php') ?>
</body>
</html>