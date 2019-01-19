<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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

Route::get('activiste', function () {
    return view('activite_specifique');
});

Route::get('connexion','ConnexionController@get' );
Route::post('connexion', 'ConnexionController@post');

Route::get('inscription','InscriptionController@get');
Route::post('inscription', 'InscriptionController@post');

Route::get('deconnexion', function () {
    Session::flush();
    return redirect('/');
} );