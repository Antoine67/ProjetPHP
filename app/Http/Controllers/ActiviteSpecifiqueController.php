<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Avis;

use Session;

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

        }else  {  // if (isset($_POST) && isset($_POST['fichier']) && isset($id_activite)
            var_dump ($_POST);
            
            exit;
        } 
        return redirect('activites/'.$id_activite);
    }
}
