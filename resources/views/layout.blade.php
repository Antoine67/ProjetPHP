<!DOCTYPE html>
<html lang="fr">
  <head>
      <title>Accueil - BDE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/layout.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    
  </head>
<header>
  <div>
        <div class="header-blue">
            <nav class="navbar navbar-default navigation-clean-search">
                <div class="container">
                    <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">BDE</a>
                        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    </div>
                    <div class="collapse navbar-collapse" id="navcol-1">
                    <!-- Barre de naviguation avec nos différentes catégories -->
                        <ul class="nav navbar-nav">

                            <li class="<?php echo ($_SERVER['REQUEST_URI'] == '/' ? 'active' : '');?>"><a href="/">Accueil</a></li>
                            <li class="<?php echo ($_SERVER['REQUEST_URI'] == '/boutique' ? 'active' : '');?>"><a href="/boutique">Boutique</a></li>
                            <li class="<?php echo ($_SERVER['REQUEST_URI'] == '/idees' ? 'active' : '');?>"><a href="/idees">Boîte à idées</a></li>
                            <li class="<?php echo ($_SERVER['REQUEST_URI'] == '/activites' ? 'active' : '');?>"><a href="/activites">Activités</a></li>
                            
                        </ul>
                        <form class="navbar-form navbar-left" target="_self">
                            <div class="form-group">
                                <label class="control-label" for="search-field"><i class="glyphicon glyphicon-search"></i></label>
                                <input class="form-control search-field" type="search" name="search" id="search-field">
                            </div>
                        </form>
                        <p class="navbar-text navbar-right">
                        <!-- Boutons permettant la connexion / deconnexion -->
                        <?php if(isset($username)) { ?>
                         
                          <div class="navbar-right dropdown"><a class="dropdown-toggle username" data-toggle="dropdown" aria-expanded="false" href="#"><?=$username?> <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a href="#">Paramètres</a></li>
                                    <li role="presentation"><a href="#">:c</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li role="presentation"><a href="#">Deconnexion</a></li>
                                </ul>
                            </div>
                        <?php } else { ?>  
                          <a class="navbar-link login" href="/connexion">Connexion</a> <a class="btn btn-default action-button" role="button" href="/inscription">Inscription</a>
                        <?php } ?>
                        </p>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>


@yield('content')

    

 
    
<footer>
        <div class="container">
            <nav class="nav-footer">
                <ul>
                    <li>
                        <a href="#">About</a>
                    </li>

                    <li>
                        <a href="#">Blog</a>
                    </li>

                    <li>
                        <a href="#">Resume</a>
                    </li>

                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>

                                  <ul>
                                      <li><a href="#"> <i class="fa fa-facebook"></i> </a></li>
                                      <li><a href="#"> <i class="fa fa-twitter"></i> </a></li>
                                      <li><a href="#"> <i class="fa fa-github"></i> </a> </li>  
                                      <li><a href="#"> <i class="fa fa-linkedin"></i> </a></li>
                                      <li><a href="#"> <i class="fa fa-envelope"></i> </a></li>
                                  </ul>

                <p class="credits text-center">&copy; ça c'est notre site hehe</p>
            </nav>
        </div>

    </footer>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</html>