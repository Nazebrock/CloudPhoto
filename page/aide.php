<?php
include('../login/verifauth.php');
?>
<!DOCTYPE html>
<html>
    <?php include("../part/import.php") ?>

    <?php include("../part/layout.php") ?>
    <div class="navbar-fixed-bottom "><a href="#menu"><h4>Haut de page</h4></a></div>
    <div class="page-wrapper" id="menu">
        <?php include("../part/bandeau.php") ?>
        <div class="row" >
            <div class="col-lg-offset-1">
                <div class="col-lg-3">
                    <div class="panel panel-info" >
                        <div class="panel-heading">Sommaire</div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="#visite">Visite guidé du site</a></li>
                                <li><a href="#import">Importer des images</a></li>
                                <li><a href="#album">Modifier/Supprimer un album</a></li>
                                <li><a href="#tag">Taguer des personnes</a></li>
                                <li><a href="#recherche">La barre de recherche</a></li>
                            </ul>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="visite">
            <div class="col-lg-offset-1">
                <div class="page-header col-lg-11"><h2>Visite guidé du site</h2></div>
            </div>
        </div>
        <div class="col-lg-offset-2">
            <p>
            <h4>Les albums :</h4>Toutes les photos du site sont réparti dans des albums repertorié dans l'onglet album de la barre de navigation.<br />
            Les albums regroupent les photos en fonction du lieu, de la date et de l'événement où elles ont été prises (Noël, Ski, anniversaire, vacances, etc).
            <h4>Les Photos :</h4>Les photos sont elles aussi tagué par date, lieu et événement mais aussi par les personnes qui sont dessus. Pour voir comment taguer des personnes sur une image c'est par <a href="#tag">ici</a><br />
            Tout ces tag permettent de retrouver plus facilement les photos grâce à la barre de recherche qui disposent de certaines fonction pour détailler la recherche (plus de détail <a href="#recherche">ici</a>)<br />
            <h4>Les Favoris :</h4>En cliquant sur une photo, il y a la possibilité de l'ajouté ou l'enlever de ses favoris en cliquant sur l'étoile <button class="btn glyphicon glyphicon-star-empty" ></button><br />
            Vous pourrez ainsi retrouver tout vos favoris dans l'onglet favoris du menu déroulant à droite de la barre de navigation.
            </p>
        </div>
        <div class="row" id="import">
            <div class="col-lg-offset-1">
                <div class="page-header col-lg-11"><h2>Importer des images</h2></div>
            </div>
        </div>
        <div class="col-lg-offset-2">
            <p>
            <u>L'upload d'image se fait en trois temps:</u>
            <h4>Selection d'album :</h4>Comme les photos sont forcement référencé dans un album, il faut choisir dans quel album les mettres, ou en creer un nouveau.
            <h4>Importer les images :</h4>Puis ensuite selectionner les images sur votre ordinateur et les envoyer. Le temps d'envoi ne dépend que de votre connexion et peut être long.<br />
            La taille total d'image importé en une fois est pour le moment limité a 500Mo.
            <h4>Ajouter des Tag :</h4>Enfin, dans la troisième parti, vous pouvez taguer des personnes sur les photos importer ou passer cette étape.
            </p>
        </div>
        <div class="row" id="album">
            <div class="col-lg-offset-1">
                <div class="page-header col-lg-11"><h2>Modifier/Supprimer un album</h2></div>
            </div>
        </div>
        <div class="col-lg-offset-2">
            <p>
            <u>Seul la personne qui a créé l'album peut le modifier ou le supprimer.</u><br />
            Pour se faire il suffit de cliquer sur l'album puis de cliquer sur le bouton <a class="btn btn-default btn-sm"><span class="glyphicon glyphicon-cog"></span></a> situé a droite du titre de l'album.
            </p>
        </div>
        <div class="row" id="tag">
            <div class="col-lg-offset-1">
                <div class="page-header col-lg-11"><h2>Taguer des personnes</h2></div>
            </div>
        </div>
        <div class="col-lg-offset-2">
            <p>
            <u>Pour taguer des personnes, il faut d'abord cliquer sur l'image, Puis vous allez voir quelque chose comme ceci :</u>
            </p>
            <img src='../image/aide_tag.jpg' />
            <p><br />
            <h4> - Vous pouvez ajouter des personnes en cliquant sur leur nom dans le menu.</h4>
            <h4>   - Vous pouvez supprimer des personnes en cliquant sur leur tag.</h4>
                <br/>
                Si vous vouler modifier les personnes déjà tagué sur la photo il suffit de cliquer sur le bouton Modifier !
            </p>
        </div>
        <div class="row" id="recherche">
            <div class="col-lg-offset-1">
                <div class="page-header col-lg-11"><h2>La barre de recherche</h2></div>
            </div>
        </div>
        <div class="col-lg-offset-2">
            <p>
            <u>La recherche peut prendre comme argument:</u>
            <ul>
                <li>Un lieu (nemour, carteret, etc)</li>
                <li>Un Evénement (Noël, Ski, anniversaire, vacances, etc)</li>
                <li>Des prénoms</li>
            </ul>
            <u>Afin de preciser la recherche on peut y ajouter des options :</u><br/>
            <dl>
                <dt>Solo</dt>
                <dd>Recherche les photos où une seul personne est tagué</dd>
                <dt>Duo</dt>
                <dd>Recherche les photos où deux personnes sont tagués</dd>
                <dt>Trio</dt>
                <dd>Recherche les photos où trois personnes sont tagués</dd>
                <dt>Groupe</dt>
                <dd>Recherche les photos où plus d'une personne sont tagués</dd>
            </dl>
            </p>
        </div>
    </div>
    <?php include('../part/footer.php') ?>
</body>
</html>