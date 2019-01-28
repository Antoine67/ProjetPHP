<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CGVController extends Controller
{
    function get() {
        return view('conditions_generale_de_ventes');
    }
}
