<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    function get($nom_panel) {
        $sess = Session('role');
        if(isset($sess) && $sess == 2) {
            return view('panel')->with('nom_panel',$nom_panel);
        }
        return redirect('/');
        
    }

    function post() {

    }
}
