<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Avis;

use App\ImageActivite;

use Session;

use Illuminate\Support\Facades\Input;


class ActiviteSpecifiqueController extends Controller
{
    function get($id_activite) {
        return view('activite_specifique')->with('id_activite', $id_activite); ;
    }

    function post(Request $request, $id_activite) {
        $sess = Session::get('identifiant');
        if (!isset($sess)) { return redirect('activites/'.$id_activite);}

        if(isset($_POST) && isset($_POST['commentaire']) && isset($id_activite)) {
            Avis::create([
                'Contenu' => $_POST['commentaire'],
                'Date_creation' => date("Y-m-d H:i:s"),
                'ID_Utilisateurs' => Session::get('id'),
                'ID_Activites' => $id_activite,
            ]);

        }else if (isset($_POST) && Input::hasFile('fichier') && isset($id_activite)) {
                $file = Input::file('fichier');
               

                $path = $_FILES['fichier']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);

                $cheminTrouvé = false;  $incr = 0;
                $chemin = 'image_site/activites/'. $id_activite . '/';
                while(!$cheminTrouvé || $incr>100){
                    $incr++;
                    if (!file_exists($chemin . 'image_'. $incr. '.'. $ext)) {
                        $file->move($chemin, 'image_'. $incr .'.'. $ext);
                        $cheminTrouvé = true;

                        ['Image','Auteur', 'ID_Activites'];

                        ImageActivite::create([
                            'Image' => $chemin . 'image_'. $incr. '.'. $ext,
                            'Auteur' => Session::get('nom') . ' ' . Session::get('prenom'),
                            'ID_Activites' => $id_activite,
                        ]);
                    }
                }

               
        }
        return redirect('activites/'.$id_activite);
        
    }
}
