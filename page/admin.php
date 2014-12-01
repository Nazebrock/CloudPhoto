<?php
session_start();
if (!isset($_SESSION['prenom'])) {
    setcookie("path", $_SERVER['REQUEST_URI'], time() + 120, "/");
    header('Location: login.php');
} else if ($_SESSION['userId'] != 1) {
    
    echo 'Acces restreint à l\'administrateur';?>
    <script language="javascript">
    <!--
        window.stop();
    -->
    </script>
<?php } ?>
<?php
include("../php/transfert_admin.php");
if (isset($_POST['prenom']) and isset($_POST['login'])) {

    ajout_utilisateur();
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

        <div class="col-lg-offset-1">
            <div class="panel panel-default col-lg-6">
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
                        </tr>
                        <?php
                        include ("../php/connection.php");
                        $req = "SELECT userid, prenom, login, email FROM UTILISATEUR";
                        $sql = mysqli_query($bdd, $req) or die(mysql_error());
                        while ($col = mysqli_fetch_row($sql)) {
                            echo '<tr><td>' . $col[0] . '</td>
                                    <td>' . $col[1] . '</td>
                                    <td>' . $col[2] . '</td>
                                    <td>' . $col[3] . '</td>
                                    <td></td>
                                    <td></td></tr>';
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


    </body>
</html>