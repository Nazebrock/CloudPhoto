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
$solo = False;
$duo = False;
$trio = False;
$groupe = False;
$option = False;
$vide = False;

//on ne garde que les lettres et les nombres
$recherche = preg_replace('/[^a-z\déô]+/i', " ", $recherche);
//on enleve les espaces en début et fin de chaine
$recherche = trim($recherche);
//on enleve les espaces multiples
$recherche = preg_replace("/\s+/", " ", $recherche);
//si la recherche est vide on affiche un message d'erreur (empeche l'affichage de toute la base)
if ($recherche == "") {
    echo '<div class="col-lg-offset-1"><h3 class="text-warning">Recherche sans argument</h3></div>';
} else {
    //on met tout en minuscule
    $recherche = strtolower($recherche);
    //on enleve les accents
    $recherche = str_replace('é', 'e', $recherche);
    $recherche = str_replace('ë', 'e', $recherche);
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
        if ($mot == "vide") {
            $vide = True;
            $option = True;
            $nbr_personne = -1;
        }
    }

    //Si deux options sont active en même temps, on envoi un message d'erreur
    if (($solo == True && ($duo == True || $trio == True || $groupe == True || $vide == True)) ||
            ($duo == True && ($solo == True || $trio == True || $groupe == True || $vide == True)) ||
            ($trio == True && ($solo == True || $duo == True || $groupe == True || $vide == True)) ||
            ($vide == True && ($solo == True || $duo == True || $groupe == True || $trio == True)) ||
            ($groupe == True && ($solo == True || $trio == True || $duo == True || $vide == True))) {
        echo '<div class="col-lg-offset-1"><h3 class="text-warning">Il ne peut y avoir qu\'une seul option "solo", "duo", "trio", "groupe" ou "vide" dans une recherche</h3></div>';
    } else {

        $sql = "SELECT img_id, tag_personne, DATE_FORMAT(T.tag_date, '%d%m%Y%H%i%s'), nom, T.userid " .
                "FROM tag T, album a WHERE tag_albumid = albumid AND ";

        if ($option == True) {
            if ($nbr_personne > 0) {
                $sql = $sql . "nbr_personne = " . $nbr_personne . "  AND";
            } else if ($nbr_personne == 0) {
                $sql = $sql . "nbr_personne > 1  AND";
            } else {
                $sql = $sql . "tag_personne = 'vide'  AND";
            }
        }
        //on rentre chaque mot dans la requête sql en fonction des options choisis
        foreach ($tab_recherche as $mot) {
            if ($mot != "solo" && $mot != "duo" && $mot != "trio" && $mot != "groupe" && $mot != "vide") {
                if ($vide == true) {
                    $sql = $sql . " (a.tag_lieu LIKE '%" . $mot . "%' OR a.tag_event LIKE '%" . $mot . "%') AND";
                } else {
                    $sql = $sql . " ( tag_personne LIKE '%" . $mot . "%' OR a.tag_lieu LIKE '%" . $mot . "%' OR a.tag_event LIKE '%" . $mot . "%') AND";
                }
            }
        }
        $sql = substr($sql, 0, strlen($sql) - 3);

        include ("../php/connection.php");

        $ret = mysqli_query($bdd, $sql) or die(mysql_error());
        //Si la recherche n'a rien renvoyé on envoi un message d'erreur

        $img = array(); //tableau contenant les données des images
        $fav = array();
        $i = 0;
        while ($col = mysqli_fetch_row($ret)) {
            $img[$i][0] = $col[0];
            $img[$i][1] = $col[1];
            $img[$i][2] = $col[2];
            $img[$i][3] = $col[3];
            $img[$i][4] = $col[4];
            $i++;
        }
        $nbr[0] = $i + 1; //nombre de photos a afficher
        mysqli_free_result($ret);
        if ($nbr == 1) {
            echo '<div class="col-lg-offset-1"><h3 class="text-warning">La recherche n\'a donné aucun résultat</h3></div>';
        }
    }
}
?>


