<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    function get() {
        $sess = Session('role');
        if(isset($sess) && $sess == 2) {
            return view('panel');
        }
        return redirect('/');
        
    }

    function post() {

    }
}
