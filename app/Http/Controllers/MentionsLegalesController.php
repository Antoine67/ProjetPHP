<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MentionsLegalesController extends Controller
{
    function get() {
        return view('mentions_legales');
    }
}
