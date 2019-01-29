<?php
$LISTE_CESI = array(
    "Aix-en-Provence",
    "Angouleme",
    "Arras",
    "Bordeaux",
    "Brest",
    "Caen",
    "Dijon",
    "Grenoble",
    "La Rochelle",
    "Le Mans",
    "Lille",
    "Lyon",
    "Montpellier",
    "Nancy",
    "Nantes",
    "Nice",
    "Orleans",
    "Paris Nanterre",
    "Pau",
    "Reims",
    "Rouen",
    "Saint-Nazaire",
    "Strasbourg",
    "Toulouse",);


    
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <title>S'inscrire</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
        <link rel="stylesheet" href="{{ asset('/fontawesome/css/all.min.css') }}">
    </head>

   



 <body> 
        <div class="center">

        <?php 

            //echo Utilisateur::all();
            //Utilisateur::create(['nom' => 'Durand','prenom' => 'Jean', 'email' => 'duraanaedadaaaa@chezlui.fr', 'motdepasse' => 'pass', 'localisation' => 'pass', 'role' => 'yolo']); 
            
            ?>


            <form action="inscription" method="POST" id="inscription">     
                @csrf             
                <div class="imgcontainer">
                    <img src="{{ asset('/img/avatar.jpg') }}" alt="Avatar" class="avatar">
				</div>
				<div>
                    <label><b>Nom</b></label>
                    <div class="errorMsg"></div>
                    <input type="text" placeholder="Votre nom" name="nom" required>

                    <label><b>Prénom</b></label>
                    <div class="errorMsg"></div>
                    <input type="text" placeholder="Votre prénom " name="prenom" required>

                    <label><b>E-mail</b></label>
                    <input id="email" type="text" placeholder="Votre adresse e-mail " name="email" required >

                    <label><b>Localisation</b></label>
                    <select name="localisation" required>
                    <option value="" selected disabled>Votre centre cesi </option>
                        <?php 
                        foreach ($LISTE_CESI as $value) {
                            $min = strtolower($value);
                           echo '<option value="'. $min .'">'. $value . '</option>';
                        }
                        
                        ?>
                    </select>


                    <label><b>Nom d'utilisateur</b></label>
                    <input type="text" placeholder="Votre identifiant de connexion" name="identifiant" required>

                    <label for="mdp"><b>Mot de passe</b></label>
                    <input type="password" id="mdp" placeholder="Votre mot de passe" name="mdp" required>

                    <label for="mdpconf"><b>Confirmer votre mot de passe</b></label>
                    <input type="password" id="mdpconf" placeholder="Confirmer votre mot de passe" name="mdpconf" required>

                    
                    <div style="display:inline-block;">
                        <input type="checkbox" id="mentions-legales" checked required>
                        <label for="mentions-legales">J'accepte les <a href="/mentions_legales">mentions légales</a></label>
                    </div>
 
                    <div id="errGnle" class="err"></div>
                    <button id="submit-button" type="submit" class="conf">S'inscrire</button>
                    <button type="button" class="cancelbtn" onclick="location.href='/';">Annuler</button>

                </div>
            </form> 
        </div>
        <script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('/js/verifForm.js') }}"></script>
    </body>

</html>