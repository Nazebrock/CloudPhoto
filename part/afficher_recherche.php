<div class="row">
    <div class="col-lg-offset-1">
        <div class="col-lg-9">
            <?php
            echo "<div class=\"page-header\"><h1>Recherche<small> | " . $recherche . "</small></h1></div>";
            ?>

        </div>
    </div>
</div>
<?php
include ("../php/transfert.php");
if (isset($_POST['selection'])) {
    ajouter_personne();
}
?>
<div class="row">
    <div class="col-lg-offset-1">
        <div class="col-lg-10">
            <?php
            $mot = explode(' ', $recherche);
            $mot = str_replace('é', 'e', $mot);
            $mot = str_replace('ô', 'o', $mot);
            include ("../php/connection.php");
            $sql = "SELECT img_id, tag_personne, DATE_FORMAT(tag_date, '%d%m%Y%H%i%s'), tag_albumid " .
                    "FROM tag " .
                    "WHERE tag_personne LIKE '%" . $mot[0] . "%' OR tag_lieu LIKE '%" . $mot[0] . "%' OR tag_event LIKE '%" . $mot[0] . "%'";
            $ret = mysqli_query($bdd, $sql) or die(mysql_error());
            while ($col = mysqli_fetch_row($ret)) {
                echo "<div class=\"col-xs-2 col-md-2\"><button type=\"button\" onclick=\"modal(" . $col[0] . ", '" . $col[1] . "', '" . $col[2] . "','" . $col[3] . "');\" data-toggle=\"modal\" data-target=\"#myModal\" class=\"thumbnail\"><img src=\"../php/thumbnail.php?id=" . $col[0] . "\"></a></div>";
            }
            ?>
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

