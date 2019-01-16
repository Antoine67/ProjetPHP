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

Route::get('activite', function () {
    return view('activite');
});

//Route::get('/activites', 'AuthController@signin');
//Route::get('/boutique', 'AuthController@gettoken');
//Route::get('/accueil', function () { return view('welcome');});
//Route::get('/idees', 'AuthController@gettoken');

Route::get('/connexion', function () { return view('login');});
