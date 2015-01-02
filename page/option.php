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
            <?php
            if (isset($_POST['email'])) {
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $req = "UPDATE utilisateur SET email = '" . $_POST['email'] . "' WHERE userid = " . $_SESSION['userId'];
                    $sql = mysqli_query($bdd, $req) or die(mysql_error());
                    echo '<div class="col-lg-offset-2"><div class="alert alert-info alert-dismissible text-center col-lg-1">Email modifié !</div></div>';
                    header('location: option.php');
                } else {
                    echo '<div class="col-lg-offset-2"><div class="alert alert-danger alert-dismissible text-center col-lg-2">Cet Email n\'est pas valide</div></div>';
                }
            }
            if (isset($_POST['pwd1']) && isset($_POST['pwd2'])) {
                if ($_POST['pwd1'] == $_POST['pwd2']) {
                    if (preg_match('`^([[:alnum:]]{6,15})$`', $_POST['pwd1'])) {
                        $req = "UPDATE utilisateur SET pass = '" . $_POST['pwd1'] . "' WHERE userid = " . $_SESSION['userId'];
                        $sql = mysqli_query($bdd, $req) or die(mysql_error());
                        echo '<div class="col-lg-offset-2"><div class="alert alert-info alert-dismissible text-center col-lg-1">Mot de passe modifié !</div></div>';
                        header('location: option.php');
                    } else {
                        echo '<div class="col-lg-offset-4"><div class="alert alert-danger alert-dismissible text-center col-lg-7">Le mot de passe ne doit contenir que des chiffres et des lettres et doit faire entre 6 et 15 charactères</div></div>';
                    }
                }
                else{
                    echo '<div class="col-lg-offset-5"><div class="alert alert-danger alert-dismissible text-center col-lg-4">Les mots de passes ne correspondent pas !</div></div>';
                }
            }
            ?>
        </div>
        <div class="row">
            <div class="col-lg-offset-1">
                <div class="col-lg-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Email
                        </div>
                        <div class="panel-body" >
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
                                <div id="msg-email"></div>
                                <div class="form-group" id="form-email">
                                    <div class="col-lg-10">
                                        <input onchange="check_email((this).value);" onkeyup="check_email((this).value);" class="form-control" name="email" id="email" placeholder="modifier adresse">
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
                            <div class="form-group" id="form-pwd1">
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" name="pwd1" id="pwd1" placeholder="Changer Mot de passe">
                                </div>
                            </div>
                            <div class="form-group" id="form-pwd2">
                                <div class="col-lg-10">
                                    <input onkeyup="check_pwd();" type="password" class="form-control" name="pwd2" id="pwd2" placeholder="Retaper Mot de passe">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info">Changer</button>
                            <div id="msg-pwd"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('../part/footer.php') ?>
</body>
</html>
<script>
    function check_email(email) {
        $('#msg-email').empty();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (re.test(email)) {
            $('#form-email').attr('class', 'form-group has-success');
            $('#msg-email').append('<div class="text-success">Email valide</div>');
        }
        else {
            $('#form-email').attr('class', 'form-group has-error');
            $('#msg-email').append('<div class="text-danger">Email non valide</div>');
        }
    }
    function check_pwd() {
        if($('#pwd1').val() == $('#pwd2').val()){
            $('#form-pwd1').attr('class', 'form-group has-success');
            $('#form-pwd2').attr('class', 'form-group has-success');
        }
        else{
            $('#form-pwd1').attr('class', 'form-group has-error');
            $('#form-pwd2').attr('class', 'form-group has-error');
        }
    }
</script>