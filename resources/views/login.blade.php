
<head>
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
</head>


<body>
        <div class="center">
            <form action="session.php" method="POST">
                <div class="imgcontainer">
                    <img src="assets/img/img_avatar.png" alt="Avatar" class="avatar">
				</div>
				<div>
                    <label for="login"><b>Nom d'utilisateur</b></label>
                    <input type="text" placeholder="Entrer votre nom d'utilisateur " name="login" required>

                    <label for="pwd"><b>Mot de passe</b></label>
                    <input type="password" placeholder="Entrer votre mot de passe" name="pwd" required>

                    <button type="submit" style="background-color:#09a02c;border:solid black 2px; ">Se connecter</button>
                   
                    <label>
                    	<input type="checkbox" checked="checked" name="remember"> Se rappeler de moi
                    </label>
                </div>

                <div class="down-container" style="background-color:#f1f1f1; border-radius:15px;">
                
                    <button type="button" class="cancelbtn" id="back">Retour</button>
                    <span class="psw"><a href="#">Mot de passe oublié?</a></span>
                    <button type="button" id="signin" >Pas encore membre ? S'inscrire</button>
                </div>
            </form> 
        </div>

	</body>