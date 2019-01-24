<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    function get() {
        $sess = Session::get('identifiant');
        if(!isset($sess)) {
            return redirect('/');
        }
        return view('profil');
    }

    function post() {
       
    }
}
