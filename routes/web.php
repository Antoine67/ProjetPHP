<?php
    //PAGES GLOBALES
Route::get('/', function () {
    return view('welcome');
});

Route::get('activites','ActiviteController@get' );
Route::post('activites','ActiviteController@post' );

Route::get('boutique', function () {
    return view('boutique');
});

Route::get('idees', function () {
    return view('idees');
});

Route::get('achat','AchatController@get' );

    //PAGES SPECIFIQUES
Route::get('activites/{id_activite}','ActiviteSpecifiqueController@get' );
Route::post('activites/{id_activite}','ActiviteSpecifiqueController@post' );



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

Route::get('ajax', function(){ return view('ajax'); });

Route::post('/postajax','AjaxController@post');
