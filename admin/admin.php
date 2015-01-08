<?php
//SET GLOBAL max_allowed_packet=20000000000;
/* Log:
 * 1 = connexion        info = NULL
 * 2 = deconnexion      info = NULL
 * 3 = creation album   info = albumId
 * 4 = suppr album      info = albumId
 * 5 = insertion image  info = img_id
 * 6 = Suppr image      info = img_id
 * 7 = clic image       info = img_id
 * 8 = tag              info = img_id
 */
include('../login/verifauth.php');
if ($_SESSION['userId'] != 1) {

    echo 'Acces restreint à l\'administrateur';
    ?>
    <script language="javascript">
        <!--
        window.stop();
    -->
    </script>
<?php } ?>
<!DOCTYPE html>
<html>
    <script src="../Bootstrap/js/blur.min.js.js"></script>

    <?php include("../part/import.php") ?>

    <?php include("../part/layout.php") ?>
    <!-- 
        Inserer un Carousel et un thumbnails
    -->
    <div class="page-wrapper">
        <?php include("../part/bandeau.php") ?>
        <?php
        include("../php/transfert_admin.php");
        if (isset($_POST['prenom']) and isset($_POST['login'])) {
            ajout_utilisateur();
        }
        if (isset($_POST['news']) && isset($_POST['contenu']) && isset($_POST['titre'])) {
            $req = "INSERT INTO news (titre, contenu)"
                    . "VALUES ('" . $_POST['titre'] . "', '" . $_POST['contenu'] . "')";
            $sql = mysqli_query($bdd, $req) or die(mysql_error());
        }
        ?>
        <div class="row">
            <div class="col-lg-offset-1">
                <div class="col-lg-7">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Utilisateur
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Id</td>
                                    <td>Prénom</td>
                                    <td>Login</td>
                                    <td>Email</td>
                                    <td>Tag</td>
                                    <td>Tagué</td>
                                    <td>Album</td>
                                    <td>Photo</td>
                                    <td>Etat</td>
                                    <td></td>
                                </tr>
                                <?php
                                include ("../php/connection.php");
                                $etat = "";
                                $option = '';
                                $req = "SELECT userid, prenom, login, email, Etat FROM utilisateur ORDER BY userId";
                                $sql = mysqli_query($bdd, $req) or die(mysql_error());
                                $user = array();
                                $i = 0;
                                while ($col = mysqli_fetch_row($sql)) {
                                    $user[$i][0] = $col[0];
                                    $user[$i][1] = $col[1];
                                    $user[$i][2] = $col[2];
                                    $user[$i][3] = $col[3];
                                    $user[$i][4] = $col[4];
                                    $i++;
                                }
                                mysqli_free_result($sql);
                                foreach ($user as $col) {
                                    $option = '<a href="modifier.php?id=' . $col[0] . '"><span class="glyphicon glyphicon-cog"></span></a>';
                                    //recupère le nombre de tag fais
                                    $req = "SELECT count(id) FROM log WHERE type = 8 AND userid =".$col[0];
                                    $sql = mysqli_query($bdd, $req) or die(mysql_error());
                                    $nbr_tag_fait = mysqli_fetch_row($sql);
                                    mysqli_free_result($sql);
                                    //recupère le nombre de fois où est tagué
                                    $req = "SELECT count(img_id) FROM tag WHERE tag_personne LIKE '%" . str_replace("é", "e", $col[1]) . "%'";
                                    $sql = mysqli_query($bdd, $req) or die(mysql_error());
                                    $nbr_tag = mysqli_fetch_row($sql);
                                    mysqli_free_result($sql);
                                    //recupère le nombre d'album
                                    $req = "SELECT count(albumId) FROM album WHERE createurid = " . $col[0];
                                    $sql = mysqli_query($bdd, $req) or die(mysql_error());
                                    $nbr_album = mysqli_fetch_row($sql);
                                    mysqli_free_result($sql);
                                    //recupere le nombre de photos
                                    $req = "SELECT count(img_id) FROM tag WHERE userid = " . $col[0];
                                    $sql = mysqli_query($bdd, $req) or die(mysql_error());
                                    $nbr_img = mysqli_fetch_row($sql);
                                    mysqli_free_result($sql);
                                    if ($col[0] == 1) {
                                        $etat = '<button class="btn btn-success"></button>';
                                    } elseif ($col[4] == 1) {
                                        $etat = '<form role="form" enctype="multipart/form-data" action="desactiver.php?id=' . $col[0] . '" method="POST"><button type="submit" class="btn btn-success"></button></form>';
                                    } elseif ($col[4] == 0) {
                                        $etat = '<form role="form" enctype="multipart/form-data" action="activer.php?id=' . $col[0] . '" method="POST"><button type="submit" class="btn btn-danger"></button></form>';
                                    }
                                    echo '<tr><td>' . $col[0] . '</td>
                                    <td>' . $col[1] . '</td>
                                    <td>' . $col[2] . '</td>
                                    <td>' . $col[3] . '</td>
                                    <td>' . $nbr_tag_fait[0] . '</td>
                                    <td>' . $nbr_tag[0] . '</td>
                                    <td>' . $nbr_album[0] . '</td>
                                    <td>' . $nbr_img[0] . '</td>
                                    <td>' . $etat . '</td>
                                    <td>' . $option . '</td>'
                                    . '</tr>';
                                }
                                ?>
                            </table>
                        </div>

                        <div class="panel-footer">
                            <form class="form-inline" role="form" enctype="multipart/form-data" action="#" method="post">
                                <div class="form-group">
                                    <div class="col-lg-10">
                                        <input class="form-control" name="prenom" id="prenom" placeholder="Prénom">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input class="form-control" name="login" id="login" placeholder="login">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-default">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Ajouter une news
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" enctype="multipart/form-data" action="#" method="post">
                                <div class="form-group">
                                    <div class="col-lg-5">
                                        <input class="form-control" maxlength="20" name="titre" id="titre" placeholder="titre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="contenu" id="contenu" placeholder="contenu"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-default" name="news" >Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Traffic
                        </div>
                        <div class="panel-body">
                            <?php
                            header('content : text/plain');
                            require_once ('jpgraph/jpgraph.php');
                            require_once ('jpgraph/jpgraph_line.php');

                            $datay1 = array(20, 15, 23, 15);
                            $datay2 = array(12, 9, 42, 8);
                            $datay3 = array(5, 17, 32, 24);

// Setup the graph
                            $graph = new Graph(300, 250);
                            $graph->SetScale("textlin");

                            $theme_class = new UniversalTheme;

                            $graph->SetTheme($theme_class);
                            $graph->img->SetAntiAliasing(false);
                            $graph->title->Set('Filled Y-grid');
                            $graph->SetBox(false);

                            $graph->img->SetAntiAliasing();

                            $graph->yaxis->HideZeroLabel();
                            $graph->yaxis->HideLine(false);
                            $graph->yaxis->HideTicks(false, false);

                            $graph->xgrid->Show();
                            $graph->xgrid->SetLineStyle("solid");
                            $graph->xaxis->SetTickLabels(array('A', 'B', 'C', 'D'));
                            $graph->xgrid->SetColor('#E3E3E3');

// Create the first line
                            $p1 = new LinePlot($datay1);
                            $graph->Add($p1);
                            $p1->SetColor("#6495ED");
                            $p1->SetLegend('Line 1');

// Create the second line
                            $p2 = new LinePlot($datay2);
                            $graph->Add($p2);
                            $p2->SetColor("#B22222");
                            $p2->SetLegend('Line 2');

// Create the third line
                            $p3 = new LinePlot($datay3);
                            $graph->Add($p3);
                            $p3->SetColor("#FF1493");
                            $p3->SetLegend('Line 3');

                            $graph->legend->SetFrameWeight(1);

// Output line
                            $graph->Stroke();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>