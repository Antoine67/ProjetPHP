<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    function post() {
        if($_POST) {

            try {
                $bdd = new PDO('mysql:host=localhost;dbname=utilisateur;charset=utf8', 'root', '');
            }
            catch(Exception $e) {
                    die('Erreur : '.$e->getMessage());
            }



            $err = 0;
            $arr = array("nom", "prenom", "email", "localisation","mdp","mdpconf");
            foreach ($arr as $value) {
                if(!isset($_POST[$value])) {
                    $value = ucfirst($value);
                    echo '<div class="err"><strong>Erreur</strong> avec le champ : « <b>' . $value .' </b>»</div>';
                    break;
                }
            }

            
        $sqlRequest = $bdd->prepare("INSERT INTO utilisateur(email, login, password) VALUES(:email,:login,:password)");


        //Empêcher injection sql
        $sqlRequest->bindValue(':email', $email, PDO::PARAM_STR);
        $sqlRequest->bindValue(':login', $login, PDO::PARAM_STR);
        $sqlRequest->bindValue(':password', $pwd, PDO::PARAM_STR);
        
        $sqlRequest->execute();


        session_start();
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['pwd'] = $_POST['pwd'];
        
        echo 'Utilisateur crée avec succés , redirection en cours';
        header('location: index.php');




        }
    }


    function get() {
        return view('inscription');
    }
}
