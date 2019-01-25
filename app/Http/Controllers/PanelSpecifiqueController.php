<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelSpecifiqueController extends Controller
{
    function get($nom_panel) {
        $sess = Session('role');
        if(isset($sess) && $sess == 2) {
            return view('panel_specifique')->with('nom_panel',$nom_panel);
        }
        return redirect('/');
        
    }
}
