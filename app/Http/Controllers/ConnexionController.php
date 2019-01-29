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
                "mdp" => sha1($_POST['mdp']),
            );


            $url="localhost:3000/api/login"; 
           
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HEADER  , true);  

            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
            curl_setopt($ch, CURLOPT_TIMEOUT, 20); 
            //Reponse
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            
            

            if ($httpcode != 200) {
                if($httpcode == 0) {
                    echo '<div class="err"><strong>Erreur</strong> de connexion à l\'API d\'authentification :<br/> Vérifiez l\'etat des serveurs ou réessayer ultérieurement</div>';;
                    return view('connexion');
                }  
                echo '<div class="err"><strong>Erreur d\'authentification</strong> :<br/> Vérifiez votre e-mail/identifiant et mot de passe </div>';;
                return view('connexion');
            } 




            //Récuperer uniquement le body
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($server_output, 0, $header_size);
            $body = substr($server_output, $header_size);
            $token = $body;
               
            
            curl_close ($ch);



            $identifiant = $_POST['identifiant'];
            $mdp = sha1($_POST['mdp']);
            
           
            $done=false;
            
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
                    Session::put('token',$token);
                    \Cookie::make('token_cookie_bde',$token,120); 
                }
                   
              
            } catch (Exception $e) {
                echo 'Erreur :'. $e;
            }

        return redirect('/');
        }
    }
}
