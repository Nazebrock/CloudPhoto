<?php
include('../login/verifauth.php');
?>
<!DOCTYPE html>
<html>
    <?php include("../part/import.php") ?>

    <?php include("../part/layout.php") ?>
    <div class="page-wrapper">
        <?php include("../part/bandeau.php") ?>
        <div class="col-lg-offset-4">
            <div class="alert alert-info col-lg-7 text-center">
                Pour le moment ce Cloud est exclusivement photo, j'ajouterai surement la gestion des vidéos dans le courrant de l'année<br>
                En attendant je met juste les montages que j'avais fais il y a longtemps.
            </div>
        </div>
        <div class="col-lg-offset-2">
            <div class="col-lg-10">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div role="tabpanel">
                            <ul class="nav nav-pills" role="tablist">
                                <li role="presentation" class="active"><a href="#mamie" aria-controls="mamie" role="tab" data-toggle="tab">80 ans de mamie</a></li>
                                <li role="presentation" ><a href="#noel" aria-controls="noel" role="tab" data-toggle="tab">Noël</a></li>
                            </ul>
 
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="mamie">
                                <div class="well">
                                    Très vieux montage vidéo sur la journée où l'on a fêté l'anniversaire de mamie.<br>
                                    Il n'y a rien à redire, c'est une vidéo de qualité : caméra HD, montage dynamique, commentaire en plein milieu de l'écran, fautes d'orthographes ...
                                </div>
                                <video controls src="../../video/80_ans_mamie.mp4">80 ans de mamie</video>
                            </div>
                            <div role="tabpanel" class="tab-pane active" id="noel">
                                <div class="well">
                                    Un Montage vidéo qui avait bugué sur le rendu à l'époque où je l'avais fait du coup il y a des images de travers et des bandes noires<br>
                                    de temps en temps. Et bien entendu, les fautes d'orthographes sont toujours présentent (c'est ma signature).
                                </div>
                                <video controls src="../../video/Noel.mp4">80 ans de mamie</video>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('../part/footer.php') ?>
</body>
</html>