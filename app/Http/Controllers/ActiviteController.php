<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Activite;

use App\ImageActivite;

use Illuminate\Support\Facades\Input;

use Session;

class ActiviteController extends Controller
{
    function get() {
        return view('activite');
    }

    function post() {
        if(isset($_POST)) {
            $role_util=Session::get('role');
            if(isset($role_util)) {
                //Ajout d'une activité
                if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['prix']) && isset($_POST['date'])) {
                    
                    
                    //CREATION DE L'ACTIVIE EN BDD
                    $date_initiale = str_replace('/', '-', $_POST['date']);
                    $date = date("Y-m-d", strtotime($date_initiale) );
                   
                    $activite = Activite::create([
                        'Titre' => $_POST['nom'],
                        'Prix' => $_POST['prix'],
                        'Date_creation' => date("Y-m-d H:i:s"),
                        'Date_realisation' => $date,
                        'Description' => $_POST['description'],
                        'ID_Utilisateurs' =>Session::get('id'),
                    ]);

                    //CREATION DE L'IMAGE EN BDD

                    $file = Input::file('fichier');
               

                    $path = $_FILES['fichier']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);

                    $cheminTrouvé = false;  $incr = 0;
                    $chemin = 'image_site/activites/'. $activite['id'] . '/';
                    while(!$cheminTrouvé || $incr>100){
                        $incr++;
                        if (!file_exists($chemin . 'image_'. $incr. '.'. $ext)) {
                            $file->move($chemin, 'image_'. $incr .'.'. $ext);
                            $cheminTrouvé = true;
    
    
                            ImageActivite::create([
                                'Image' => $chemin . 'image_'. $incr. '.'. $ext,
                                'Auteur' => Session::get('nom') . ' ' . Session::get('prenom'),
                                'ID_Activites' => $activite['id'],
                            ]);
                        }
                    }
                    return redirect('/activites');
                }else {
                    //Suppression d'une activité
                    if(isset($_POST['id-activite'])) {

                        $image_activites = ImageActivite::where("ID_Activites",$_POST['id-activite']);
                        $activites = $image_activites->get();
                        foreach ($activites as $activite) {
                            if(file_exists($activite['Image'])) {
                                unlink($activite['Image'] );
                                echo 'Supprimé : ' . $activite['Image'] ;
                            }else {
                                echo 'Non trouvé : ' . $activite['Image'] ;
                            }

                            
        
                        }
                        $image_activites->delete();
                        echo 'Suppression OK';

                        Activite::where('ID',$_POST['id-activite'])->delete();
                        
                        return redirect('/activites');
                    }
                }
            }else {
                echo 'Vous devez être connecté pour effectuer ce genre d\'action !';
            }
 

        }
    }
}
