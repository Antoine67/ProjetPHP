
<head>
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
</head>


<body>
        <div class="center">
            <form action="login.php" method="POST">
                <div class="imgcontainer">
                    <img src="img_avatar.png" alt="Avatar" class="avatar">
                </div>

                <div class="container">
                    <label for="login"><b>Nom d'utilisateur</b></label>
                    <input type="text" placeholder="Entrer votre nom d'utilisateur " name="login" required>

                    <label for="pwd"><b>Mot de passe</b></label>
                    <input type="password" placeholder="Entrer votre mot de passe" name="pwd" required>

                    <button type="submit">Se connecter</button>
                    <label>
                    <input type="checkbox" checked="checked" name="remember"> Se rappeler de moi
                    </label>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" class="cancelbtn">Annuler</button>
                    <span class="psw"><a href="#">Mot de passe oublié?</a></span>
                </div>
            </form> 
        </div>

    </body>