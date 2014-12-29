<?php
//SET GLOBAL max_allowed_packet=20000000000;
include('../login/verifauth.php');
if ($_SESSION['userId'] != 1) {

    echo 'Acces restreint à l\'administrateur';
    ?>
    <script language="javascript">
        <!--
        window.stop();
    -->
    </script>
<?php } ?>
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
        <?php
        include("../php/transfert_admin.php");
        if (isset($_POST['prenom']) and isset($_POST['login'])) {
            ajout_utilisateur();
        }
        ?>
        <div class="col-lg-offset-1">
            <div class="col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Utilisateur
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tr>
                                <td>Id</td>
                                <td>Prénom</td>
                                <td>Login</td>
                                <td>Email</td>
                                <td>nbr Album</td>
                                <td>nbr Photo</td>
                                <td>Etat</td>
                                <td></td>
                            </tr>
                            <?php
                            include ("../php/connection.php");
                            $etat = "";
                            $option = '';
                            $req = "SELECT userid, prenom, login, email, Etat FROM UTILISATEUR ORDER BY userId";
                            $sql = mysqli_query($bdd, $req) or die(mysql_error());
                            while ($col = mysqli_fetch_row($sql)) {
                                $option = '<a href="modifier.php?id=' . $col[0] . '"><span class="glyphicon glyphicon-cog"></span></a>';
                                if ($col[0] == 1) {
                                    $etat = '<button class="btn btn-success"></button>';
                                }
                                elseif ($col[4] == 1) {
                                    $etat = '<form role="form" enctype="multipart/form-data" action="desactiver.php?id=' . $col[0] . '" method="POST"><button type="submit" class="btn btn-success"></button></form>';
                                } elseif($col[4] == 0) {
                                    $etat = '<form role="form" enctype="multipart/form-data" action="activer.php?id=' . $col[0] . '" method="POST"><button type="submit" class="btn btn-danger"></button></form>';
                                }
                                echo '<tr><td>' . $col[0] . '</td>
                                    <td>' . $col[1] . '</td>
                                    <td>' . $col[2] . '</td>
                                    <td>' . $col[3] . '</td>
                                    <td></td>
                                    <td></td>
                                    <td>' . $etat . '</td>
                                    <td>' . $option . '</td>'
                                . '</tr>';
                            }
                            ?>
                        </table>
                    </div>

                    <div class="panel-footer">
                        <form class="form-inline" role="form" enctype="multipart/form-data" action="#" method="post">
                            <div class="form-group">
                                <div class="col-lg-10">
                                    <input class="form-control" name="prenom" id="prenom" placeholder="Prénom">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <input class="form-control" name="login" id="login" placeholder="login">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <input class="form-control" name="email" id="email" placeholder="Email">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>