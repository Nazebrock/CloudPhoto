<?php
session_start();
?>
<!DOCTYPE html>
<html>

    <?php include("../part/import.php") ?>

    <?php include("../part/layout.php") ?>

    <div class="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron text-center">
                    <h2>Bienvenue sur le cloud Photo des LORRAIN !</h2>
                    <h3>Stat:</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-offset-1">
                <div class="col-lg-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Email
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <tr>
                                    <td><?php
                                        include("../php/connection.php");
                                        $req = "SELECT email FROM utilisateur WHERE "
                                                . "UserId = " . $_SESSION['userId'];
                                        $ret = mysqli_query($bdd, $req) or die(mysql_error());
                                        $res = mysqli_fetch_row($ret);
                                        echo $res[0];
                                        mysqli_free_result($ret);
                                        ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <form class="form-inline" role="form" enctype="multipart/form-data" action="#" method="post">
                                <div class="form-group">
                                    <div class="col-lg-10">
                                        <input class="form-control" name="email" id="email" placeholder="modifier adresse">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Modifier</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Mot de Passe
                    </div>
                    <div class="panel-body">
                        <form class="form-inline" role="form" enctype="multipart/form-data" action="#" method="post">
                            <div class="form-group">
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" name="email" id="email" placeholder="Changer Mot de passe">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" name="email" id="email" placeholder="Retaper Mot de passe">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info">Changer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>