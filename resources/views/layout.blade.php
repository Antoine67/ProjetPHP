
<?php 

$username = Session::get('identifiant');

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <link rel="stylesheet" href="{{ asset('/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/layout.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">

    <script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
    
  </head>
<header>
  <div>
        <div class="header">
            <nav class="navbar navbar-default navigation-clean-search">
                <div class="container">
                    <div class="navbar-header"><a class="navbar-brand navbar-link" href="/">BDE</a></div>
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
                                    <li role="presentation"><a href="#">?</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li role="presentation"><a href="/deconnexion">Deconnexion</a></li>
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

    
    

</html>