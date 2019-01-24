<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Idee;

use Session;

use Illuminate\Support\Facades\Input;

class IdeeController extends Controller
{
    function get() {
        return view('idees');
    }

    function post() {
        $sess = Session::get('identifiant');
        print_r($_POST);
        if(isset($_POST) &&  isset($sess)) {
            
            $file = Input::file('fichier');

            if(isset($_POST['nom']) && isset($_POST['description']) && isset($file)) {
               
                $idee = Idee::create([
                    'Titre' => $_POST['nom'],
                    'Contenu' => $_POST['description'],
                    'Date_creation' => date("Y-m-d H:i:s"),
                    'Etat' => 1,
                    'ID_Utilisateurs' => Session::get('id'),
                    'Image' => '/aucune',
                ]);

                $path = $_FILES['fichier']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);

                $cheminTrouvé = false;  $incr = 0;
                $chemin = 'image_site/idees/'. $idee['id'] . '/';
                while(!$cheminTrouvé || $incr>100){
                    $incr++;
                    if (!file_exists($chemin . 'image_'. $incr. '.'. $ext)) {
                        $file->move($chemin, 'image_'. $incr .'.'. $ext);
                        $cheminTrouvé = true;

                        $idee->update('Image','image_'. $incr .'.'. $ext) ;
                    }
                }
            }
        }
    }
}
