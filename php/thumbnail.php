<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
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
        
        $NouvelleLargeur = 200; //Largeur choisie à 350 px mais modifiable
        $NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur) / $TailleImageChoisie[0])) );

        $NouvelleImage = imagecreatetruecolor($NouvelleLargeur, $NouvelleHauteur) or die("Erreur");

        imagecopyresampled($NouvelleImage, $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0], $TailleImageChoisie[1]);
        imagedestroy($ImageChoisie);
        
        header("Content-type: image/jpeg");
        imagejpeg($NouvelleImage, null, 85);
        

        
    }
} else {
    echo "Mauvais id d'image";
}
?>
