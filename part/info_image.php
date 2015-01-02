<div class="col-lg-offset-4">
    <div class="alert alert-info col-lg-5" role="alert">Vous pouvez taguer des personnes sur la photo en cliquant dessus</div>
</div>
<div class="row">
    <div class="col-lg-offset-1">
        <div class="col-lg-9">
            <?php
            $imageId = explode(".", $img);
            $taille = count($imageId);
            include ("../php/connection.php");
            
            //recupere les favoris
            $favoris = "False";
            $req = "SELECT imgId FROM favoris WHERE UserID = " . $_SESSION['userId'];
            $ret = mysqli_query($bdd, $req) or die(mysql_error());

            $fav = array();
            while ($col = mysqli_fetch_array($ret)) {
                $fav[] = $col[0];
            }
            mysqli_free_result($ret);

            for ($i = 1; $i < $taille; $i++) {
                $req = "SELECT tag.img_id, tag.tag_personne, DATE_FORMAT(tag.tag_date, '%d%m%Y%H%i%s'), album.nom FROM tag, album WHERE "
                        . "tag.tag_albumId = album.albumId AND "
                        . "img_id =" . $imageId[$i];
                $ret = mysqli_query($bdd, $req) or die(mysql_error());
                $col = mysqli_fetch_row($ret);
                
                foreach ($fav as $id) {
                    if ($col[0] == $id) {
                        //L'image fais partie des favoris de l'utilisateur 
                        $favoris = "True";
                    }
                }
                echo "<div class=\"col-xs-2 col-md-2\"><button type=\"button\" onclick=\"modal(" . $col[0] . ", '" . $col[1] . "', '" . $col[2] . "','" . $col[3] . "', '" . $favoris . "', " . $_SESSION['userId'] . ");\" data-toggle=\"modal\" data-target=\"#myModal\" class=\"thumbnail\"><img src=\"../php/thumbnail.php?id=" . $col[0] . "&size=200\"></a></div>";
                mysqli_free_result($ret);
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
