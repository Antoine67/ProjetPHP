<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class AdministrationController extends Controller
{
    function get() {
        $sess = Session::get('role');
        if(isset($sess) && $sess == '3') {
            return view('administration');
        }
        return redirect ('/');
       
    }
}
