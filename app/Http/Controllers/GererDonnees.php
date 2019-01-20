<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;

use Session;

class GererDonnees extends Controller
{
    function post() {
        $sess = Session::get('identifiant');
        if(isset($_POST) && isset($sess)) {//Si non vide et que l'utilisateur est bien connecté
            if(isset($_POST['action'])) {//Si il y a un  bien une action précisée
                switch($_POST['action']) {//Determiner quelle action
                    case('like') : {
                        if(isset($_POST['like']) && isset($_POST['id'])) {

                            if($_POST['like'] == "0") {//Enlever un like

                                $like = Like::where('ID_Utilisateurs',Session::get('id'))->where('ID_Image_activites',$_POST['id'])->delete();
                            
                            }else {//Ajouter un like

                                Like::create([
                                    'ID_Image_activites' => $_POST['id'],
                                    'ID_Utilisateurs' => Session::get('id'),
                                    'Positif' => true
                                ]);

                            }
                        }
                        break;
                    }
                }
            }
        }
    }
}
