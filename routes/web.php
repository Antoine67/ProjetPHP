<?php
    //PAGES GLOBALES
Route::get('/', function () {
    return view('welcome');
});

Route::get('activites','ActiviteController@get' );
Route::post('activites','ActiviteController@post' );

Route::get('boutique','BoutiqueController@get' );
Route::post('boutique','BoutiqueController@post' );

Route::get('idees','IdeeController@get');
Route::post('idees', 'IdeeController@post');

Route::get('profil','ProfilController@get');
Route::post('profil', 'ProfilController@post');

Route::get('achat','AchatController@get' );

    //PAGES SPECIFIQUES
Route::get('activites/{id_activite}','ActiviteSpecifiqueController@get' );
Route::post('activites/{id_activite}','ActiviteSpecifiqueController@post' );

Route::get('boutique/{categorie}','BoutiqueController@categorieSpecifique');

Route::get('boutique/article/{id_article}','BoutiqueController@articleSpecifique');

Route::get('/recherche?article={article}','BoutiqueController@rechercheArticle');


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

