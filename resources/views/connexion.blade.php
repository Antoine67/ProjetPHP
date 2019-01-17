
<head>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
</head>


<body>
        <div class="center">
            <form action="connexion" method="POST">
                @csrf    
                <div class="imgcontainer">
                    <img src="{{ asset('/img/avatar.jpg') }}" alt="Avatar" class="avatar">
				</div>
				<div>
                    <label for="identifiant"><b>Nom d'utilisateur ou adresse e-mail</b></label>
                    <input type="text" placeholder="Entrer votre nom d'utilisateur " name="identifiant" required>

                    <label for="mdp"><b>Mot de passe</b></label>
                    <input type="password" placeholder="Entrer votre mot de passe" name="mdp" required>

                    <button type="submit" style="background-color:#09a02c;border:solid black 2px; ">Se connecter</button>
                    
                </div>

                <div class="down-container" style="background-color:#f1f1f1; border-radius:15px;">
                    <span class="psw"><a href="#">Mot de passe oublié?</a></span>                  

                    <button type="button" onclick="location.href='/inscription';">Pas encore membre ? S'inscrire</button>

                    <button type="button" onclick="location.href='/';" class="cancelbtn" >Retour</button>
                </div>
            </form> 
        </div>

	</body>