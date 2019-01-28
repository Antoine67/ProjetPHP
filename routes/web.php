<?php
    //PAGES GLOBALES
Route::get('/', function () {
    return view('welcome');
});

Route::get('activites','ActiviteController@get' );
Route::post('activites','ActiviteController@post' );

Route::get('boutique','BoutiqueController@get' );
Route::post('boutique','BoutiqueController@post' );

Route::post('boutique/article','BoutiqueController@ajoutArticlePanier');

Route::get('idees','IdeeController@get');
Route::post('idees', 'IdeeController@post');

Route::get('profil','ProfilController@get');
Route::post('profil', 'ProfilController@post');

Route::get('achat','AchatController@get' );
Route::post('achat','AchatController@post');

Route::get('panel','PanelController@get' );
Route::post('panel','PanelController@post' );

Route::get('administration-cesi','AdministrationController@get');

    //PAGES SPECIFIQUES
Route::get('activites/{id_activite}','ActiviteSpecifiqueController@get' );
Route::post('activites/{id_activite}','ActiviteSpecifiqueController@post' );

Route::get('panel/{nom_panel}','PanelSpecifiqueController@get' );
Route::post('panel/{nom_panel}','PanelSpecifiqueController@post' );

Route::get('boutique/{categorie}','BoutiqueController@categorieSpecifique');

Route::get('boutique/article/{id_article}','BoutiqueController@articleSpecifique');

Route::get('/recherche','BoutiqueController@rechercheArticle');

    //MENTIONS LEGALES
Route::get('mentions_legales','MentionsLegalesController@get');
Route::get('conditions_generale_de_ventes','CGVController@get');


    //CONNEXION / DECONNEXION / INSCRIPTION
Route::get('connexion','ConnexionController@get' );
Route::post('connexion', 'ConnexionController@post');

Route::get('inscription','InscriptionController@get');
Route::post('inscription', 'InscriptionController@post');

Route::get('deconnexion', function () {
    Session::flush();
    return redirect('/');
} );

    //PAGE GESTION DONNEE AJAX
Route::post('gerer-donnees','GererDonnees@post');

