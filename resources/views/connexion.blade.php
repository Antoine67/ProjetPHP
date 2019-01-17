
<head>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
</head>


<body>
        <div class="center">
            <form action="session.php" method="POST">
                <div class="imgcontainer">
                    <img src="{{ asset('/img/avatar.jpg') }}" alt="Avatar" class="avatar">
				</div>
				<div>
                    <label for="login"><b>Nom d'utilisateur ou adresse e-mail</b></label>
                    <input type="text" placeholder="Entrer votre nom d'utilisateur " name="login" required>

                    <label for="pwd"><b>Mot de passe</b></label>
                    <input type="password" placeholder="Entrer votre mot de passe" name="pwd" required>

                    <button type="submit" style="background-color:#09a02c;border:solid black 2px; ">Se connecter</button>
                    
                </div>

                <div class="down-container" style="background-color:#f1f1f1; border-radius:15px;">
                    <span class="psw"><a href="#">Mot de passe oublié?</a></span>                  

                    <button type="button" href="/inscription">Pas encore membre ? S'inscrire</button>

                    <button type="button" class="cancelbtn" id="back">Retour</button>
                </div>
            </form> 
        </div>

	</body>