<div class="row">
    <div class="col-lg-offset-3">
        <div class="col-lg-6">
            <div class="col-xs-3 col-md-3 text-center">
                <a href="creer_album.php" class="thumbnail">
                    <img src="../image/nouveau.jpg">
                    <div class="caption">
                        <h5 >Creer Album</h5>
                    </div>
                </a>
            </div>
            <?php
            include ("../php/connection.php");
            $reqalbum = "SELECT nom, albumid " .
                    "FROM album ORDER BY nom";
            $retalbum = mysqli_query($bdd, $reqalbum) or die(mysql_error());
            while ($col = mysqli_fetch_row($retalbum)) {
                $req = "SELECT MIN(img_id) " .
                        "FROM tag where tag_albumid=" . $col[1];
                $ret = mysqli_query($bdd, $req) or die(mysql_error());
                $img = mysqli_fetch_row($ret);
                echo "<div class=\"col-xs-3 col-md-3 text-center\">".
                     "<a href=\"insertion.php?id=2&album=" . $col[1] . "\" class=\"thumbnail\">".
                     "<img src=\"../php/thumbnail.php?id=" . $img[0] . "\">".
                     "<div class=\"caption\">".
                     "<h5>" . $col[0] . "</h5></div></a></div>";
            }
            ?>
        </div> 
    </div>
</div>
