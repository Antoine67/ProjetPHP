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
        $sess = Session::get('identifiant');
        if (isset($sess)) {//Déjà connecté
            return redirect('/');
        }

        if($_POST) { // Si ce n'est pas vide
            //Connexion à la BDD
            try {
                $bdd = DB::connection('mysql2')->getPdo();
               
            }catch(\PDOException $e) { //Imposible de se connecter à la base
                echo '<div class="err">Impossible de se connecter au serveur d\'autentification : Réessayez ultérieurement</div>';
                return view('connexion');
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

            $data = array(
                "identifiant" => $_POST['identifiant'],
                "mdp" => $_POST['mdp'],
            );
           
            /*
            
            $postdata = json_encode($data);
            //$postdata = http_build_query($arr);
            
            $url = 'http://localhost:3000/api/login';
            
            $context = stream_context_create(array(
                'http' => array( 
                    'method' => 'POST', 
                    'header' => 'Content-type: application/json',
                    'content' => http_build_query( $data),
                    )));
            
            $resp = file_get_contents($url, FALSE, $context); 
            print_r($resp); 
                    */
                    /*

            $ch = curl_init();
 
            //Set the URL that you want to GET by using the CURLOPT_URL option.
            curl_setopt($ch, CURLOPT_URL, 'http://google.com');
            
            //Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            //Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            
            //Execute the request.
            $data = curl_exec($ch);
            
            //Close the cURL handle.
            curl_close($ch);
            
            //Print the data out onto the page.
            echo $data;
            exit;*/










            $identifiant = $_POST['identifiant'];
            $mdp = $_POST['mdp'];
            $done=false;
            //On verifie que l'email n'existe pas déjà
            try {
                while(!$done) {
                    $reponse = $bdd->prepare('SELECT mot_de_passe FROM utilisateurs WHERE email=:identifiant AND Mot_de_passe=:mdp');
                    $reponse->bindValue(':identifiant', $identifiant, $bdd::PARAM_STR);
                    $reponse->bindValue(':mdp', $mdp, $bdd::PARAM_STR);
                    $reponse->execute(); 
         
                    if($reponse->fetch()) {
                        $email = $identifiant;
                        break;
                    }

                    $reponse = $bdd->prepare('SELECT mot_de_passe FROM utilisateurs WHERE identifiant=:identifiant AND Mot_de_passe=:mdp');
                    $reponse->bindValue(':identifiant', $identifiant, $bdd::PARAM_STR);
                    $reponse->bindValue(':mdp', $mdp, $bdd::PARAM_STR);
                    $reponse->execute();

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

            //Ici tout est vérifié nous pouvons récupérer les données de l'utilisateur
            try {
                if(isset($email)) {
                    $reponse = $bdd->prepare('SELECT * FROM utilisateurs WHERE email=:email');
                    $reponse->bindValue(':email', $email, $bdd::PARAM_STR);
                    $reponse->execute();
                }else if (isset($pseudo)) {
                    $reponse = $bdd->prepare('SELECT * FROM utilisateurs WHERE identifiant=:email');
                    $reponse->bindValue(':email', $pseudo, $bdd::PARAM_STR);
                    $reponse->execute();
                }

                if($donnee=$reponse->fetch()) {
                    Session::put('id', $donnee['ID']);
                    Session::put('nom', $donnee['Nom']);
                    Session::put('prenom', $donnee['Prenom']);
                    Session::put('identifiant', $donnee['Identifiant']);
                    Session::put('email', $donnee['Email']);
                    Session::put('localisation', $donnee['Localisation']);
                    Session::put('role', $donnee['Role']);
                    Session::put('mdp', $donnee['Mot_de_passe']);
                }
                   
              
            } catch (Exception $e) {
                echo 'Erreur :'. $e;
            }

        return redirect('/');
        }
    }
}
