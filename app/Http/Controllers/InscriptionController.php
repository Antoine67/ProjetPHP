<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Session;



class InscriptionController extends Controller
{
  

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
            $arr = array("nom", "prenom", "email", "localisation","identifiant","mdp","mdpconf");
            foreach ($arr as $value) {
                if(!isset($_POST[$value])) {
                    $value = ucfirst($value);
                    echo '<div class="err"><strong>Erreur</strong> avec le champ : « <b>' . $value .' </b>»</div>';
                    break;
                }else {
                    $$value = $_POST[$value];
                }
            }

            //On verifie que l'email n'existe pas déjà
            try {
                $reponse = $bdd->query('SELECT 1 FROM utilisateurs WHERE email="'.$email.'"');
                if($reponse->fetch()) {
                    echo '<div class="err"><strong>Erreur</strong> l\'email : « <b>' . $email .' </b>» est déjà utilisée</div>';
                    return view('inscription');
                } 
                
                $reponse = $bdd->query('SELECT 1 FROM utilisateurs WHERE identifiant="'.$identifiant.'"');
                if($reponse->fetch()) {
                    echo '<div class="err"><strong>Erreur</strong> l\'identifiant : « <b>' . $identifiant .' </b>» est déjà utilisé</div>';
                    return view('inscription');
                } 
            } catch (Exception $e) {
                echo 'error';
            }



            
        $sqlRequest = $bdd->prepare("INSERT INTO utilisateurs(nom, prenom , mot_de_passe, email, localisation,identifiant) VALUES(:nom,:prenom,:mdp,:email,:localisation,:identifiant)");


        //Empêcher injection sql
        $sqlRequest->bindValue(':nom', $nom, $bdd::PARAM_STR);
        $sqlRequest->bindValue(':prenom', $prenom, $bdd::PARAM_STR);
        $sqlRequest->bindValue(':mdp', $mdp, $bdd::PARAM_STR);
        $sqlRequest->bindValue(':email', $email, $bdd::PARAM_STR);
        $sqlRequest->bindValue(':localisation', $localisation, $bdd::PARAM_STR);
        $sqlRequest->bindValue(':identifiant', $identifiant, $bdd::PARAM_STR);
        
        $sqlRequest->execute();


        session_start();
        Session::put('nom', $nom);
        Session::put('prenom', $prenom);
        Session::put('email', $email);
        Session::put('localisation', $localisation);
        Session::put('identifiant', $identifiant);
        
        echo '<div class="alert alert-success" style="margin-bottom:0px;" role="alert">Utilisateur crée avec succés ! Bienvenue <strong>' . strtoupper($nom) .' '. ucfirst ($prenom) . ' </strong></div>';
        return redirect('/');

        }
    }


    function get() {
        $sess = Session::get('identifiant');
        if (isset($sess)) {
            return redirect('/');
        }
        return view('inscription');
    }
}
