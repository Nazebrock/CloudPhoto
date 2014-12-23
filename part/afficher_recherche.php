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
            $solo = False;
            $duo = False;
            $trio = False;
            $groupe = False;
            $option = False;


            //on ne garde que les lettres et les nombres
            $recherche = preg_replace('/[^a-z\d]+/i', " ", $recherche);
            //on enleve les espaces en début et fin de chaine
            $recherche = trim($recherche);
            //on enleve les espaces multiples
            $recherche = preg_replace("/\s+/", " ", $recherche);
            //si la recherche est vide on affiche un message d'erreur (empeche l'affichage de toute la base)
            if ($recherche == "") {
                echo '<h3 class="text-warning">Recherche sans argument</h3>';
            } else {
                //on met tout en minuscule
                $recherche = strtolower($recherche);
                //on enleve les accents
                $recherche = str_replace('é', 'e', $recherche);
                $recherche = str_replace('ô', 'o', $recherche);
                $tab_recherche = explode(' ', $recherche);

                $nbr_personne = 0;
                //on test si une option est activé
                foreach ($tab_recherche as $mot) {
                    if ($mot == "solo") {
                        $solo = True;
                        $nbr_personne = 1;
                        $option = True;
                    }
                    if ($mot == "duo") {
                        $duo = True;
                        $nbr_personne = 2;
                        $option = True;
                    }
                    if ($mot == "trio") {
                        $trio = True;
                        $nbr_personne = 3;
                        $option = True;
                    }
                    if ($mot == "groupe") {
                        $groupe = True;
                        $option = True;
                    }
                }

                //Si deux options sont active en même temps, on envoi un message d'erreur
                if (($solo == True && ($duo == True || $trio == True || $groupe == True)) ||
                        ($duo == True && ($solo == True || $trio == True || $groupe == True)) ||
                        ($trio == True && ($solo == True || $duo == True || $groupe == True)) ||
                        ($groupe == True && ($solo == True || $trio == True || $duo == True))) {
                    echo '<h3 class="text-warning">Il ne peut y avoir qu\'une seul option "solo", "duo", "trio" ou "groupe" dans une recherche</h3>';
                } else {

                    $sql = "SELECT img_id, tag_personne, DATE_FORMAT(tag_date, '%d%m%Y%H%i%s'), tag_albumid " .
                            "FROM tag WHERE ";

                    if ($option == True) {
                        if ($nbr_personne != 0) {
                            $sql = $sql . "nbr_personne = " . $nbr_personne . "  AND";
                        } else {
                            $sql = $sql . "nbr_personne > 1  AND";
                        }
                    }
                    //on rentre chaque mot dans la requête sql en fonction des options choisis
                    foreach ($tab_recherche as $mot) {

                        if ($mot != "solo" && $mot != "duo" && $mot != "trio" && $mot != "groupe") {
                            $sql = $sql . " ( tag_personne LIKE '%" . $mot . "%' OR tag_lieu LIKE '%" . $mot . "%' OR tag_event LIKE '%" . $mot . "%') AND";
                        }
                    }
                    $sql = substr($sql, 0, strlen($sql) - 3);
                    echo $sql;

                    include ("../php/connection.php");

                    $ret = mysqli_query($bdd, $sql) or die(mysql_error());
                    //Si la recherche n'a rien renvoyé on envoi un message d'erreur

                    if("l" == "") {
                        echo '<h3 class="text-warning">La recherche n\'a donné aucun résultat</h3>';
                    } else {
                        while ($col = mysqli_fetch_row($ret)) {
                            echo "<div class=\"col-xs-2 col-md-2\"><button type=\"button\" onclick=\"modal(" . $col[0] . ", '" . $col[1] . "', '" . $col[2] . "','" . $col[3] . "');\" data-toggle=\"modal\" data-target=\"#myModal\" class=\"thumbnail\"><img src=\"../php/thumbnail.php?id=" . $col[0] . "\"></a></div>";
                        }
                    }
                }
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

