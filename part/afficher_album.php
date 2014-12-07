<div class="row">
    <div class="col-lg-offset-1">
        <div class="col-lg-9">
            <?php
            include ("../php/connection.php");
            $req = "SELECT nom, DATE_FORMAT(tag_date, '%d/%m/%Y'), tag_lieu, tag_event " .
                    "FROM album WHERE albumid = " . $albumId;
            $ret = mysqli_query($bdd, $req) or die(mysql_error());
            $album = mysqli_fetch_row($ret);
            mysqli_free_result($ret);
            echo "<div class=\"page-header\"><h1>" . $album[0] . "<small> | " . $album[3] . " à " . $album[2] . " le " . $album[1] . "</small><a href=\"modifier_album.php?id=" . $albumId . "\"class=\"btn btn-default btn-sm\"><span class=\"glyphicon glyphicon-cog\"></span></a></h1></div>";
            ?>

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
            //recupere les favoris
            $favoris = "False";
            $req = "SELECT imgID FROM FAVORIS WHERE UserID = '" . $_SESSION['userId'] . "' AND imgID IN " .
                    "(SELECT imgID FROM TAG WHERE Tag_albumId = '" . $albumId . "')";
            $ret = mysqli_query($bdd, $req) or die(mysql_error());
            $fav = array();
            while ($col = mysqli_fetch_array($ret)) {
                $fav[] = $col[0];
            }
            mysqli_free_result($ret);

            //on recupere le nombre de photo à afficher
            $req = "SELECT count(img_id) FROM tag WHERE tag_albumid = " . $albumId;
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
                $req = "SELECT img_id, tag_personne, DATE_FORMAT(tag_date, '%d%m%Y%H%i%s') FROM tag WHERE tag_albumid = " . $albumId;
                $ret = mysqli_query($bdd, $req) or die(mysql_error());
                ?>

                <!-- Tab panes -->
                <div class="tab-content">
                    <?php
                    $cpt = 1;
                    $i = 1;
                    while ($col = mysqli_fetch_row($ret)) {
                        if($cpt == 1 ){
                            echo '<div role="tabpanel" class="tab-pane active" id="' . $i . '">';
                            $i++;
                        }
                        else if ($cpt % 43 == 0) {
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
                        echo "<div class=\"col-xs-2 col-md-2\"><button type=\"button\" onclick=\"modal(" . $col[0] . ", '" . $col[1] . "', '" . $col[2] . "','" . $album[0] . "', '" . $favoris . "', " . $_SESSION['userId'] . ");\" "
                        . "data-toggle=\"modal\" data-target=\"#myModal\" class=\"thumbnail\"><img src=\"../php/thumbnail.php?id=" . $col[0] . "\"></a></div>";
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
                            <div id="personne" ></div>                            
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

