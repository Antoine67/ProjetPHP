<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;

use App\Inscription;

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
                    case ('inscription-activite'): {

                        if(isset($_POST['inscription']) && isset($_POST['id-activite'])) {
                          
                            if($_POST['inscription'] == "true") {
                                $alreadyExistant = sizeof(Inscription::where('ID_Utilisateurs',Session::get('id'))->where('ID_Activites',$_POST['id-activite'])->get());
                               
                                if($alreadyExistant == 0) {
                                    Inscription::create([
                                        'Date_inscription' => date("Y-m-d H:i:s"),
                                        'ID_Utilisateurs' => Session::get('id'),
                                        'ID_Activites' => $_POST['id-activite'],
                                    ]);
                                }else {
                                    return response("Erreur : impossible de trouver l'utilisateur à desincrire", 404);
                                }
                            }else {
                                Inscription::where('ID_Utilisateurs',Session::get('id'))->where('ID_Activites',$_POST['id-activite'])->delete();
                            }
                            
                        }

                        break;
                    }
                }
            }
        }
    }
}