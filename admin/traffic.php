<?php
header('content : text/plain');
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
        <?php include("../part/bandeau.php") ?>

        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Traffic
                </div>
                <div class="panel-body">
                    <?php
                    include ('../php/chart.php');
                    graph("test");
                    ?>
                    <img src="../image/test.jpg">
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>