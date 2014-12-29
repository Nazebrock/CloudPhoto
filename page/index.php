<?php
include('../login/verifauth.php');
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
        <?php include("../part/bandeau.php") ?>
        <?php
        include ("../php/connection.php");
        $req = "SELECT img_ID FROM image ORDER BY creation_date DESC LIMIT 10";
        $ret = mysqli_query($bdd, $req) or die(mysql_error());
        $img = array();
        while ($col = mysqli_fetch_array($ret)) {
            $img[] = $col[0];
        }
        mysqli_free_result($ret);
        ?>
        <div class="row">
            <div class="col-lg-offset-1">
                <div class="col-lg-5">
                    <div class="panel panel-info">
                        <div class="panel-heading">10 dernières photos</div>
                        <div class="panel-body">
                            <div id="carousel" class="carousel slide " data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <?php
                                    for ($i = 0; $i < 10; $i++) {
                                        if ($i == 0) {
                                            echo '<li data-target="#carousel" data-slide-to="' . $img[$i] . '" class="active"></li>';
                                        }
                                        echo '<li data-target="#carousel" data-slide-to="' . $img[$i] . '"></li>';
                                    }
                                    ?>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <?php
                                    for ($i = 0; $i < 10; $i++) {
                                        if ($i == 0) {
                                            echo '<div class="item active"><img src="../php/thumbnail.php?id=' . $img[$i] . '&size=1000"></div>';
                                        }
                                        echo '<div class="item"><img src="../php/thumbnail.php?id=' . $img[$i] . '&size=1000"></div>';
                                    }
                                    ?>
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="panel panel-info">
                    <div class="panel-heading">BETA NEWS</div>
                    <div class="panel-body">
                    </div>
                </div>
            </div>
        </div>
        
            <?php include('../part/footer.php')?>

    </body>
</html>
