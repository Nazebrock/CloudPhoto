<div class="row">
    <div class="col-lg-offset-1">
        <div class="col-lg-9">
            <div class="page-header"><h1>Mes favoris</h1></div>
        </div>
    </div>

</div>
<?php
include ("../php/transfert.php");
if (isset($_POST['favoris'])) {
    favoris();
} else if (isset($_POST['selection'])) {
    ajouter_personne();
}
?>
<div class="row">
    <div class="col-lg-offset-1">
        <div class="col-lg-10">
            <?php
            include ("../php/connection.php");
            //recupere les favoris
            $favoris = "False";
            $req = "SELECT imgId FROM FAVORIS WHERE UserID = " . $_SESSION['userId'];
            $ret = mysqli_query($bdd, $req) or die(mysql_error());

            $fav = array();
            while ($col = mysqli_fetch_array($ret)) {
                $fav[] = $col[0];
            }
            mysqli_free_result($ret);

            //on recupere le nombre de photo à afficher
            $req = "SELECT count(img_id) FROM TAG, ALBUM WHERE "
                    . "TAG.tag_albumId = ALBUM.albumId AND "
                    . "img_id IN (SELECT imgId FROM FAVORIS WHERE userId = " . $_SESSION['userId'] . ")";
            $ret = mysqli_query($bdd, $req) or die(mysql_error());
            $nbr = mysqli_fetch_row($ret);
            mysqli_free_result($ret);
            ?>
            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <?php
                    for ($i = 1; $i <= ($nbr[0] / 42) + 1; $i++) {
                        if ($i == 1) {
                            echo '<li role="presentation" class="active"><a href="#' . $i . '" aria-controls="' . $i . '" role="tab" data-toggle="tab">' . $i . '</a></li>';
                        } else {
                            echo '<li role="presentation" ><a href="#' . $i . '" aria-controls="' . $i . '" role="tab" data-toggle="tab">' . $i . '</a></li>';
                        }
                    }
                    ?>
                </ul>
                <?php
                //recupere les image de l'album
                $req = "SELECT TAG.img_id, TAG.tag_personne, DATE_FORMAT(TAG.tag_date, '%d%m%Y%H%i%s'), ALBUM.nom FROM TAG, ALBUM WHERE "
                        . "TAG.tag_albumId = ALBUM.albumId AND "
                        . "img_id IN (SELECT imgId FROM FAVORIS WHERE userId = " . $_SESSION['userId'] . ")";
                $ret = mysqli_query($bdd, $req) or die(mysql_error());
                ?>

                <!-- Tab panes -->
                <div class="tab-content">
                    <?php
                    $cpt = 1;
                    $i = 1;
                    while ($col = mysqli_fetch_row($ret)) {
                        if ($cpt == 1) {
                            echo '<div role="tabpanel" class="tab-pane active" id="' . $i . '">';
                            $i++;
                        } else if ($cpt % 43 == 0) {
                            echo '<div role="tabpanel" class="tab-pane" id="' . $i . '">';
                            $i++;
                        }
                        $favoris = "False";
                        foreach ($fav as $id) {
                            if ($col[0] == $id) {
                                //L'image fais partie des favoris de l'utilisateur
                                $favoris = "True";
                            }
                        }
                        echo "<div class=\"col-xs-2 col-md-2\"><button type=\"button\" onclick=\"modal(" . $col[0] . ", '" . $col[1] . "', '" . $col[2] . "','" . $col[3] . "', '" . $favoris . "', " . $_SESSION['userId'] . ");\" "
                        . "data-toggle=\"modal\" data-target=\"#myModal\" class=\"thumbnail\"><img src=\"../php/thumbnail.php?id=" . $col[0] . "&size=200\"></a></div>";
                        if ($cpt % 42 == 0) {
                            echo '</div>';
                        }
                        $cpt++;
                    }
                    mysqli_free_result($ret);
                    ?>

                </div>
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <div class="modal-body thumbnail">
                            <img id="modal-image" src="">
                            <div id="personne" class="" ></div>                            
                        </div>
                        <div class="modal-footer" >
                            <div id="menu_personne"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../Bootstrap/js/tag_personne.js"></script>

