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
    return view('activite_template');
});

//Route::get('/activites', 'AuthController@signin');
//Route::get('/boutique', 'AuthController@gettoken');
//Route::get('/accueil', function () { return view('welcome');});
//Route::get('/idees', 'AuthController@gettoken');

Route::get('/connexion', function () { return view('connexion');});
Route::get('/inscription', function () { return view('inscription');});