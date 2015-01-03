<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class=" collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li class="navbar-text text-info">*BETA*</li>
                <li><a class="navbar-brand" href="../index.php"><img src="../image/logo_b.jpg" alt=""/></a></li>
                <?php if($_SESSION['userId'] != 1){
                    echo '<li><a  href="insertion.php?id=1">Importer</a></li>';
                }?>
                <li class="dropdown">
                    <a href="album.php" class="dropdown-toggle" data-toggle="dropdown">Album <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        include ("../php/connection.php");
                        $req = "SELECT nom, albumid " .
                                "FROM album ORDER BY nom";
                        $ret = mysqli_query($bdd, $req) or die(mysql_error());
                        while ($col = mysqli_fetch_row($ret)) {
                            echo "<li><a href=\"afficher.php?id=1&album=" . $col[1] . "\">" . $col[0] . "</a></li>";
                        }
                        mysqli_free_result($ret);
                        mysqli_close($bdd);
                        ?>
                    </ul>
                </li>
            </ul>
            <?php
            include ("../php/rechercher.php");
            if (isset($_POST['recherche'])) {
                chercher();
            }
            ?>
            <form class="navbar-form navbar-nav" role="form" enctype="multipart/form-data" action="#" method="post">
                <div class="form-group">
                    <input type="text" name="recherche" class="form-control" placeholder="Rechercher des photos">
                </div>
                <button type="submit" class="btn btn-default glyphicon glyphicon-search" ></button>
            </form>
            <ul class="nav navbar-nav navbar-right hidden-xs">
                <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['prenom']; ?><span class="caret"></span></a>
                     <ul class="dropdown-menu" role="menu">
                     <li><a href="afficher.php?id=3"><span class="glyphicon glyphicon-star right"></span>Favoris</a></li>
                     <li><a href="option.php"><span class="glyphicon glyphicon-cog"></span>Option</a></li>
                     <li class="divider"></li>
                     <li><a href="aide.php"><span class="glyphicon glyphicon-question-sign"></span>Aide</a></li>
                     <?php 
                        if($_SESSION['userId'] == 1){
                            echo '<li><a href="../admin/admin.php"><span class="glyphicon glyphicon-wrench"></span>Admin</a></li>';
                        }
                     ?>
                     <li><a href="../login/logout.php"><span class="glyphicon glyphicon-off"></span>Deconexion</a></li>
                     </ul>
                </li>
            </ul>

        </div>
    </div>
</div>