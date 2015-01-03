<?php
if (isset($_GET['id']) && isset($_GET['size'])) {
    $id = intval($_GET['id']);
    $size = intval($_GET['size']);
    include ("connection.php");
    $req = "SELECT img_id, img_type, img_blob " .
            "FROM image WHERE img_id = " . $id;
    $ret = mysqli_query($bdd, $req) or die(mysql_error());
    $col = mysqli_fetch_row($ret);
    if (!$col[0]) {
        echo "Id d'image inconnu";
    } else {

        $ImageChoisie = imagecreatefromstring($col[2]);
        
        $TailleImageChoisie = getimagesizefromstring($col[2]);
        
        if($TailleImageChoisie[1] >= $TailleImageChoisie[0]){//si la largeur est plus grade que la hauteur
            $NouvelleLargeur = $size;
            $NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur) / $TailleImageChoisie[0])) );
        }
        elseif($TailleImageChoisie[0] > $TailleImageChoisie[1]){//si la hauteur est plus grande que la largeur
            $NouvelleHauteur = $size;
            $NouvelleLargeur = ( ($TailleImageChoisie[0] * (($NouvelleHauteur) / $TailleImageChoisie[1])) );
        }
        $NouvelleImage = imagecreatetruecolor($NouvelleLargeur, $NouvelleHauteur) or die("Erreur");

        imagecopyresampled($NouvelleImage, $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0], $TailleImageChoisie[1]);
        imagedestroy($ImageChoisie);
        
        header("Content-type: ".$col[1]);
        imagejpeg($NouvelleImage, null, 85);

    }
} else {
    echo "Mauvais id d'image";
}
?>
