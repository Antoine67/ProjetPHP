<?php
    //PAGES GLOBALES
Route::get('/', function () {
    return view('welcome');
});

Route::get('activites', function () {
    return view('activite');
});

Route::get('boutique', function () {
    return view('boutique');
});

Route::get('idees', function () {
    return view('idees');
});


    //PAGES SPECIFIQUES
Route::get('activites/{id_activite}', function ($id_activite) { //On envoie à la page quel ID d'activité est demandé
    return view('activite_specifique')->with('id_activite', $id_activite); ;
});




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