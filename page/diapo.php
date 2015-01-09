<?php
include('../login/verifauth.php');
if (isset($_GET['id'])) {
    $id = strval($_GET['id']);
    $img = explode('.', $id);
    $nbr = count($img) - 1;
}
?>
<!DOCTYPE html>
<html>
    <?php include("../part/import.php") ?>

    <body style="background-color: black">
    <div class="page-wrapper">
        <div class="col-lg-offset-1">
            <div class="col-lg-10">
                <div id="carousel" class="carousel slide text-center" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php
                        for ($i = 0; $i < $nbr; $i++) {
                            if ($i == 0) {
                                echo '<div class="item active" ><img src="../php/thumbnail.php?id=' . $img[$i] . '&heigth=1080"></div>';
                            } else {
                                echo '<div class="item" ><img src="../php/thumbnail.php?id=' . $img[$i] . '&heigth=1080"></div>';
                            }
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
</body>
</html>
