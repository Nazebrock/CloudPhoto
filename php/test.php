<?php

function thumbnail($id) {
    include ("connection.php");
    $req = "SELECT img_id, img_type, img_blob " .
            "FROM image WHERE img_id = " . $id;
    $ret = mysqli_query($bdd, $req) or die(mysql_error());
    $col = mysqli_fetch_row($ret);
    if (!$col[0]) {
        echo "Id d'image inconnu";
    } else {

        //on format le blob en jpeg et on le stock temporairement
        $Imagejpeg = imagecreatefromstring($col[2]);
        imagejpeg($Imagejpeg, "image/tmp.jpg");

        //on cree un thumbnail de l'image
        $ImageChoisie = imagecreatefromjpeg("image/tmp.jpg");
        $TailleImageChoisie = getimagesize("image/tmp.jpg");
        $NouvelleLargeur = 350; //Largeur choisie à 350 px mais modifiable

        $NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur) / $TailleImageChoisie[0])) );

        $NouvelleImage = imagecreatetruecolor($NouvelleLargeur, $NouvelleHauteur) or die("Erreur");

        imagecopyresampled($NouvelleImage, $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0], $TailleImageChoisie[1]);
        imagedestroy($ImageChoisie);

        //on stock le thumbnail temporairement
        imagejpeg($NouvelleImage, "image/th.jpg");
        echo "<img src=\"apercu.php \">";

    }
}
?>
