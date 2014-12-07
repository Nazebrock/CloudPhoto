<?php
session_start();
if (!isset($_SESSION['prenom'])) {
    setcookie("path", $_SERVER['REQUEST_URI'], time() + 120, "/");
    header('Location: login/login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>orrain</title>

        <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/jpeg" href="image/logo.jpg" />

        <script src="Bootstrap/js/jquery-1.10.2.js"></script>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
        <script src="Bootstrap/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="Bootstrap/font-awesome/css/font-awesome.min.css"></script>

        <link href="Bootstrap/css/sb-admin.css" rel="stylesheet">
        <script src="Bootstrap/js/sb-admin-2.js.js"></script>

    </head>

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class=" collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-lef">
                    <li><a class="navbar-brand" href="../index.php">Acceuil</a></li>
                    <li><a  href="page/insertion.php?id=1">Importer</a></li>
                    <li class="dropdown">
                        <a href="page/album.php" class="dropdown-toggle" data-toggle="dropdown">Album <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            include ("php/connection.php");
                            $req = "SELECT nom, albumid " .
                                    "FROM album ORDER BY nom";
                            $ret = mysqli_query($bdd, $req) or die(mysql_error());
                            while ($col = mysqli_fetch_row($ret)) {
                                echo "<li><a href=\"page/afficher.php?id=1&album=" . $col[1] . "\">" . $col[0] . "</a></li>";
                            }
                            mysqli_free_result($ret);
                            mysqli_close($bdd);
                            ?>
                        </ul>
                    </li>
                </ul>
                <?php
                include ("php/rechercher.php");
                if (isset($_POST['recherche'])) {
                    chercher();
                }
                ?>
                <form class="navbar-form navbar-nav" role="form" enctype="multipart/form-data" action="#" method="post">
                    <div class="form-group">
                        <input type="text" name="recherche" class="form-control" placeholder="Rechercher des photo">
                    </div>
                    <button type="submit" class="btn btn-default" >Chercher</button>
                </form>
                <ul class="nav navbar-nav navbar-right hidden-xs">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['prenom']; ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"><span class="glyphicon glyphicon-star right"></span>Favoris</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-cog"></span>Option</a></li>
                            <li class="divider"></li>
                            <li><a href=" login/logout.php"><span class="glyphicon glyphicon-off"></span>Deconexion</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </div>
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

        <div class="row">
            <div class="col-lg-offset-4">
                <div class="col-lg-5">

                </div>
            </div>
        </div>

    </body>
</html>
