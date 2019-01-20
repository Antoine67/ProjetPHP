<?php
$LISTE_CESI = array(
    "Aix-en-Provence",
    "Angoulême",
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
    "Orléans",
    "Paris Nanterre",
    "Pau",
    "Reims",
    "Rouen",
    "Saint-Nazaire",
    "Strasbourg",
    "Toulouse",);
?>

    <head>

        <title>S'inscrire</title>

        <meta charset="utf-8" />
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">
    </head>

   



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
                    <div class="errorMsg"></div>
                    <input type="text" placeholder="Votre nom" name="nom" required>

                    <label for="prenom"><b>Prénom</b></label>
                    <div class="errorMsg"></div>
                    <input type="text" placeholder="Votre prénom " name="prenom" required>

                    <label for="email"><b>E-mail</b></label>
                    <div class="errorMsg"></div>
                    <input type="text" placeholder="Votre adresse e-mail " name="email" onblur="verifMail(this)" required >

                    <label for="localisation"><b>Localisation</b></label>
                    <select name="localisation" required>
                    <option value="0" selected disabled>Votre centre cesi </option>
                        <?php 
                        foreach ($LISTE_CESI as $value) {
                            $min = strtolower($value);
                           echo '<option value="'. $min .'">'. $value . '</option>';
                        }
                        
                        ?>
                    </select>


                    <label for="identifiant"><b>Nom d'utilisateur</b></label>
                    <div class="errorMsg"></div>
                    <input type="text" placeholder="Votre identifiant de connexion" name="identifiant" required>

                    <label for="mdp"><b>Mot de passe</b></label>
                    <div class="errorMsg"></div>
                    <input type="password" id="mdp" placeholder="Votre mot de passe" name="mdp" onblur="verifMdp(this)" required>

                    <label for="mdpconf"><b>Confirmer votre mot de passe</b></label>
                    <div class="errorMsg"></div>
                    <input type="password" id="mdpconf" placeholder="Confirmer votre mot de passe" name="mdpconf" onblur="verifConfMdp(this)" required>

                    <button type="submit" class="conf">S'inscrire</button>
                    <button type="button" class="cancelbtn" onclick="location.href='/';">Annuler</button>

                </div>
            </form> 
        </div>
        <script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('/js/verifForm.js') }}"></script>
    </body>

