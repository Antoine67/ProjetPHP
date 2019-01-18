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
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
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

            //echo Utilisateur::all();
            //Utilisateur::create(['nom' => 'Durand','prenom' => 'Jean', 'email' => 'duraanaedadaaaa@chezlui.fr', 'motdepasse' => 'pass', 'localisation' => 'pass', 'role' => 'yolo']); 
            
            ?>


            <form action="inscription" method="POST">     
                @csrf             

                <div class="imgcontainer">
                    <img src="{{ asset('/img/avatar.jpg') }}" alt="Avatar" class="avatar">
				</div>
				<div>
                    <label for="nom"><b>Nom</b></label>
                    <input type="text" placeholder="Votre nom" name="nom" required>

                    <label for="prenom"><b>Prénom</b></label>
                    <input type="text" placeholder="Votre prénom " name="prenom" required>

                    <label for="email"><b>E-mail</b></label>
                    <input type="text" placeholder="Votre adresse e-mail " name="email" onblur="verifMail(this)" required >

                    <label for="localisation"><b>Localisation</b></label>
                    <select name="localisation" required>
                    <option value="0" selected disabled > Votre centre cesi </option>
                        <?php 
                        $arr = array("Lingolsheim","Alger","Reims","Nanterre","Orléans");
                        foreach ($arr as $value) {
                            $min = strtolower($value);
                           echo '<option value="'. $min .'">'. $value . '</option>';
                        }
                        
                        ?>
                    </select>


                    <label for="identifiant"><b>Nom d'utilisateur</b></label>
                    <input type="text" placeholder="Votre identifiant de connexion" name="identifiant" required>

                    <label for="mdp"><b>Mot de passe</b></label>
                    <input type="password" placeholder="Votre mot de passe" name="mdp" required>

                    <label for="mdpconf"><b>Confirmer votre mot de passe</b></label>
                    <input type="password" placeholder="Confirmer votre mot de passe" name="mdpconf" required>

                    <button type="submit" style="background-color:#09a02c;border:solid black 2px; ">S'inscrire</button>
                    <button type="button" style="background-color:#ff0000;" href="/">Annuler</button>

                </div>
            </form> 
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="{{ asset('/js/verifForm.js') }}"></script>
    </body>

