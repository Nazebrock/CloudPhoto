<?php

function chercher(){
    $recherche = $_POST['recherche'];
    header('Location: ../page/afficher.php?id=2&recherche='.$recherche);
}

?>