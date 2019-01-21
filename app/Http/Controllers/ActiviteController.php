<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activite;
use Session;
class ActiviteController extends Controller
{
    function get() {
        return view('activite');
    }

    function post() {
        if(isset($_POST)) {
            ['Titre','Prix','Description','Date_realisation','Date_creation','ID_Utilisateurs'];

            if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['prix']) && isset($_POST['date'])) {

                $date =$_POST['date'];
                $date=new \DateTime($date,timezone_open('Europe/Rome'));
                echo $date;exit;

                Activite::create([
                    'Titre' => $_POST['nom'],
                    'Prix' => $_POST['prix'],
                    'Date_creation' => date("Y-m-d H:i:s"),
                    'Date_realisation' => date_format($date,"Y-m-d H:i:s"),
                    'Description' => $_POST['description'],
                    'ID_Utilisateurs' =>Session::get('id'),
                ]);
           }

        }
    }
}
