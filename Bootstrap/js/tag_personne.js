//initialise la preview d'une photo
function modal(id, personne, date, album, favoris, userId, createurId) {
    $('#personne').empty();
    $('#menu_personne').empty();
    $('#myModalLabel').empty();
    $('#btn_close').empty();
    var date_format = '';
    var menu = '';
    var separateur = ["", "/", "", "/", "", "", "", " ", "", ":", "", ":", "", ""];
    for (i = 0; i < date.length; i++) {
        var c = date.charAt(i);
        date_format += c + separateur[i];
    }
    if(userId == createurId || userId == 1){
        $('#btn_close').append('<button type="button" class="btn btn_danger" data-toggle="modal" data-target="#modal">Supprimer</button>');
        $('#suppr_id').val(id);
    }
    else{
        $('#btn_close').append('<button type="submit" class="close" data-dismiss="modal" name="supprimer"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>');
    }
    //Si l'image ne fais pas partie des favoris de l'utilisateur on affiche une etoile bleu
    if (favoris == "True") {
        var favoris = '<form class="form form-inline" role="form" enctype="multipart/form-data"  method="post">'
                      +'<input type="hidden" id="favoris" name="favoris">'
                      +'<button onclick = "enlever_favoris('+id+','+userId+');" type="submit" class="btn btn-warning glyphicon glyphicon-star" ></button>';
    }
    //Si l'image ne fais pas partie des favoris de l'utilisateur on affiche une etoile jaune
    else {
        var favoris = '<form class="form form-inline" role="form" enctype="multipart/form-data"  method="post">'
                      +'<input type="hidden" id="favoris" name="favoris">'
                      +'<button onclick = "ajouter_favoris('+id+','+userId+');" type="submit" class="btn glyphicon glyphicon-star-empty" ></button>';
    }
    //creation du titre de la photo
    var titre = favoris + "    " + album + '<small> | ' + date_format + '</small>' +'</form>';
    //Si personne n'est tagué on affiche le menu pour taguer des personnes
    if (personne == 0) {

        modifier_personne(personne, id);
    }
    //Sinon on affiche les personnes taggé sur la photo
    else {
        afficher_personne(personne, id);
    }
    //on ajoute le titre
    $('#myModalLabel').append(titre);
    //on ajoute la photo
    $('#modal-image').attr('src', '../php/thumbnail.php?id=' + id + '&size=1200');


}
//affiche les personnes taggé sur la photo
function afficher_personne(personne, id) {
    var contenu = '<h4>Personne(s):</h4>';
    var nom = personne.split(",");
    for (i = 0; i < nom.length; i++) {
        contenu = contenu + '<span class="label label-default">' + nom[i] + '</span>';
    }
    $('#personne').append(contenu);
    $('#menu_personne').append('<button onclick="modifier_personne(\'' + personne + '\', ' + id + ');" type="button" class="btn btn-primary">Modifier</button>');
}
//affiche le champ de selection pour tagger des personnes
function modifier_personne(personne, id) {
    $('#personne').empty();
    $('#menu_personne').empty();
    var nom = ['Adrien', 'Alain', 'Aline', 'Audrey', 'Benjamin', 'Bérénice', 'Enzo', 'Gérald', 'Gustave', 'Hervé', 'Jean-Christophe', 'Jeanine', 'Jérôme', 'Julie', 'Mael', 'Marianne', 'Martine', 'Mila', 'Patou', 'Patricia', 'Philippe', 'Renaud', 'Sylvie', 'Thomas']
    menu =
            '<form class="navbar-form navbar-left" role="form" enctype="multipart/form-data"  method="post">'
            + '<dev class="dropdown">'
            + '<input onkeyup="recherche((this).value);" class="form-control" class="dropdown-toggle"  autocomplete="off" data-toggle="dropdown">'
            + '<input type="hidden" id="selection" name="selection">'
            + '<ul class="dropdown-menu" role="menu" id="menu">'
            + '</ul>'
            + '</dev>'
            + '<button onclick="terminer(' + id + ');" type="submit" class="btn btn-primary">Sauvegarder</button>'
            + '</form>';

    $('#menu_personne').append(menu);
    for (i = 0; i < nom.length; i++) {
        $('#menu').append('<li><a onclick="ajouter(\'' + nom[i] + '\')">' + nom[i] + '</a></li>');
    }
    if (personne == 0) {
        $('#personne').append('<h4>Personne(s):</h4>');
    }
    else {
        var contenu = '<h4>Personne(s):</h4>';
        var nom = personne.split(",");
        for (i = 0; i < nom.length; i++) {
            contenu = contenu + '<span onclick="enlever(\'' + nom[i] + '\');" class="label label-default">' + nom[i] + '</span>';
        }
        $('#personne').append(contenu);
    }
}
//Recherche les noms
function recherche(mot) {
    $('#menu').empty();
    var nom = ['Adrien', 'Alain', 'Aline', 'Audrey', 'Benjamin', 'Bérénice', 'Enzo', 'Gérald', 'Gustave', 'Hervé', 'Jean-Christophe', 'Jeanine', 'Jérôme', 'Julie', 'Mael', 'Marianne', 'Martine', 'Mila', 'Patou', 'Patricia', 'Philippe', 'Renaud', 'Sylvie', 'Thomas'];
    for (i = 0; i < mot.length; i++) {
        var c_mot = mot.charAt(i).toLowerCase();
        for (j = 0; j < nom.length; j++) {
            var c = nom[j].charAt(i).toLowerCase();
            if (c_mot != c) {
                nom.splice(j, 1);
                j--;
            }
        }
    }
    for (i = 0; i < nom.length; i++) {
        $('#menu').append('<li><a onclick="ajouter(\'' + nom[i] + '\')">' + nom[i] + '</a></li>');
    }
}
//ajoute un tag
function ajouter(nom) {
    if ($('#personne').html().search(nom) == -1) {
        $('#personne').append('<span onclick="enlever(\'' + nom + '\');" class="label label-default">' + nom + '</span>');
    }
}
//enleve un tag
function enlever(nom) {
    var contenu = $('#personne').html();
    contenu = contenu.replace('<span onclick="enlever(\'' + nom + '\');" class="label label-default">' + nom + '</span>', " ");
    $('#personne').empty();
    $('#personne').append(contenu);

}
//termine la modification des tag
function terminer(id) {
    var val = id + '!';
    var contenu = $('#personne').html();

    var nom = ['Adrien', 'Alain', 'Aline', 'Audrey', 'Benjamin', 'Bérénice', 'Enzo', 'Gérald', 'Gustave', 'Hervé', 'Jean-Christophe', 'Jeanine', 'Jérôme', 'Julie', 'Mael', 'Marianne', 'Martine', 'Mila', 'Patou', 'Patricia', 'Philippe', 'Renaud', 'Sylvie', 'Thomas'];
    for (i = 0; i < nom.length; i++) {
        if (contenu.search(nom[i]) != -1) {
            val = val + nom[i] + ',';
        }
    }
    val = val.replace('é', 'e');
    val = val.replace('ô', 'o');

    $('#selection').val(val);
}
function enlever_favoris(id, userId) {
    var val = "0,"+userId+","+id;
    $('#favoris').val(val);
}
function ajouter_favoris(id, userId) {
    var val = "1,"+userId+","+id;
    $('#favoris').val(val);
}