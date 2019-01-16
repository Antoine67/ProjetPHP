<?php
session_start(); // On démarre la session AVANT toute chose
$cookieLogin = "";

if(isset($_COOKIE['pseudo']) && $_COOKIE['pseudo']!='required' ) {
    $cookieLogin = $_COOKIE['pseudo'];
}

if(isset($_GET['err'])) {
    $errCode = intval($_GET['err']);
}
?>

    <head>

        <title>S'inscrire</title>

        <meta charset="utf-8" />

        <link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">
    </head>

   
<style>
.err {
    color: red;
    background-color: #FFD2D2;
    border: 3px solid red;
    border-radius:5px;
    padding:5px;
    text-align:center;
    font-size:22px;
}
</style>





 <body> 
        <div class="center">

        <?php 

            use App\Utilisateur;

            //echo Utilisateur::all();
            //Utilisateur::create(['nom' => 'Durand','prenom' => 'Jean', 'email' => 'duraanaedadaaaa@chezlui.fr', 'motdepasse' => 'pass', 'localisation' => 'pass', 'role' => 'yolo']); 
            if($_POST) {
                $err = 0;
                $arr = array("nom", "prenom", "email", "localisation","mdp","mdpconf");
                foreach ($arr as $value) {
                    if(!isset($_POST[$value])) {
                        $value = ucfirst($value);
                        echo '<div class="err"><strong>Erreur</strong> avec le champ : « <b>' . $value .' </b>»</div>';
                        break;
                    }
                }
            }

           

            
            ?>


            <form action="" method="POST">                  

                <div class="imgcontainer">
                    <img src="img_avatar.png" alt="Avatar" class="avatar">
				</div>
				<div>
                    <label for="nom"><b>Nom</b></label>
                    <input type="text" placeholder="Votre nom" name="nom" required>

                    <label for="prenom"><b>Prénom</b></label>
                    <input type="text" placeholder="Votre prénom " name="prenom" required>

                    <label for="email"><b>E-mail</b></label>
                    <input type="text" placeholder="Votre adresse e-mail " name="email" required>

                    <label for="localisation"><b>Localisation</b></label>
                    <input type="text" placeholder="Votre centre CESI " name="localisation" required>

                    <label for="mdp"><b>Mot de passe</b></label>
                    <input type="password" placeholder="Votre mot de passe" name="mdp" required>

                    <label for="mdpconf"><b>Confirmer votre mot de passe</b></label>
                    <input type="password" placeholder="Confirmer votre mot de passe" name="mdpconf" required>

                    <button type="submit" style="background-color:#09a02c;border:solid black 2px; ">S'inscrire</button>
                    <button type="button" style="background-color:#ff0000;" id="back">Annuler</button>

                </div>
            </form> 
        </div>

    </body>

    <script>
        var btn = document.getElementById('back');
    	btn.addEventListener('click', function() {
            history.go(-1);
    });
    </script>
