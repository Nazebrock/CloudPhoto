<?php
//SET GLOBAL max_allowed_packet=20000000000;
include('../login/verifauth.php');
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}
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
                    $req = "SELECT login, prenom, email " .
                            "FROM utilisateur WHERE userid = " . $id;
                    $ret = mysqli_query($bdd, $req) or die(mysql_error());
                    $info_user = mysqli_fetch_row($ret);
                    mysqli_free_result($ret);

                    if(isset($_POST['nom']) and isset($_POST['login'])){
                        $req = "UPDATE utilisateur "
                                ."SET login = '".$_POST['login']."', prenom = '".$_POST['nom']."', email = '".$_POST['email']."' "
                                . "WHERE userid = ". $id;
                        $ret = mysqli_query($bdd, $req) or die(mysql_error());
                        header('Location: admin.php');
                    }
                    ?>
                    <div class="page-header">
                        <h1>Modification d'utilisateur<small> | <?php echo $info_user[1] ?></small></h1>
                    </div>
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" action="#" method="post">
                        <div class="form-group has-warning">
                            <label for="login" class="col-sm-2 control-label">login</label>
                            <div class="col-sm-5">
                                <input class="form-control" name="login" id="login" value="<?php echo $info_user[0] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nom" class="col-sm-2 control-label">nom</label>
                            <div class="col-sm-5">
                                <input class="form-control" name="nom" id="nom" value="<?php echo $info_user[1] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">email</label>
                            <div class="col-sm-5">
                                <input class="form-control" name="email" id="email" value="<?php echo $info_user[2] ?>">
                            </div>
                        </div>
                        <div class="col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</div>
</body>
</html>