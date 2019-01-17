<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Session;

class ConnexionController extends Controller
{
    function get (){ 
        $sess = Session::get('identifiant');
        if (isset($sess)) {
            return redirect('/');
        }
        return view('connexion');
    }

    function post() {
        if($_POST) { // Si ce n'est pas vide
            //Connexion à la BDD
            try {
                $bdd = DB::connection('mysql2')->getPdo();
               
            }
            catch(Exception $e) {
                    die('Erreur : '.$e->getMessage());
            }


            //On verifie qu'une requête POST n'a pas été envoyé avec des champs vides
            $arr = array("identifiant", "mdp");
            foreach ($arr as $value) {
                if(!isset($_POST[$value])) {
                    $value = ucfirst($value);
                    echo '<div class="err"><strong>Erreur</strong> avec le champ : « <b>' . $value .' </b>»</div>';
                    exit;
                }
            }

            $identifiant = $_POST['identifiant'];
            $mdp = $_POST['mdp'];
            $done=false;
            //On verifie que l'email n'existe pas déjà
            try {
                while(!$done) {
                    $reponse = $bdd->query('SELECT mot_de_passe FROM utilisateurs WHERE email="'.$identifiant.'"');
                    if($reponse->fetch()) {
                        $email = $identifiant;
                        break;
                    }
                    $reponse = $bdd->query('SELECT mot_de_passe FROM utilisateurs WHERE identifiant="'.$identifiant.'"');
                    if($reponse->fetch()) {
                        $pseudo = $identifiant;
                        break;
                    }
    
                    echo '<div class="err"><strong>Erreur</strong> de connexion : Vérifiez votre e-mail/identifiant et mot de passe </div>';;
                    return view('connexion');
                }
               
                          
            } catch (Exception $e) {
                echo 'Erreur :'. $e;
            }


            Session::put('identifiant', $identifiant);
        
        
        return redirect('/');
        }
    }
}
