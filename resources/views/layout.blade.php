
<?php 

$username = Session::get('identifiant');

$page = $_SERVER['REQUEST_URI'];
$page = substr($page,1);

if(empty($page)) {
    $page='accueil';
}

$page = ucfirst($page);

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <link rel="stylesheet" href="{{ asset('/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">

    <title>BDE - <?= $page ?></title>

    <script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
    
  </head>
<header>
  <div>
        <div class="header">
            <nav class="navbar navbar-default navigation-clean-search">
                <div class="container">
                    <div class="navbar-header"><a class="navbar-brand navbar-link" href="/">BDE</a>
                        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Naviguer</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
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

                        <!-- Utilisateur connecté - accès à ses fonctionnalités -->
                        <?php if(isset($username)) { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown"><a class="dropdown-toggle username" data-toggle="dropdown" aria-expanded="false" href="#"><?=$username?> <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a href="#">Paramètres</a></li>
                                    <li role="presentation"><a href="#">?</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li role="presentation"><a href="/deconnexion">Deconnexion</a></li>
                                </ul>
                            </li>
                            <!-- Panier de l'utilisateur -->
                            <li>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                    <i class="fas fa-shopping-basket fa-2x"></i>
                                </button>
                            </li>

                            <!-- Mini-fenêtre (modal) -->
                            <li>
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>

                                                <h3 class="modal-title" id="titre-modal">Votre panier</h3>

                                            </div>
                                            <!-- Contenu du panier -->
                                            <div class="modal-body basket-content">
                                                <div class="article">
                                                    <img class="img-panier" src="{{ asset('/img/badminton.png') }}" alt="article"> <b>5€</b> - Article 1
                                                    <div class="article-chg">
                                                        <button type="button" class="btn btn-danger">-</button>
                                                        <span class="nb-article">5</span>
                                                        <button type="button" class="btn btn-success">+</button>  
                                                    </div>
                                                </div>
                                                <div class="article">
                                                    <img class="img-panier" src="{{ asset('/img/badminton.png') }}" alt="article"> <b>5€</b> - Article 2
                                                    
                                                    <div class="article-chg">
                                                        <button type="button" class="btn btn-danger">-</button>
                                                        <span class="nb-article">5</span>
                                                        <button type="button" class="btn btn-success">+</button>  
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Boutons de fermeture du panier + Prix -->
                                            <div class="modal-footer">
                                                <div class="total">
                                                    <h5 id="total-articles">Nombre d'articles : 5</h5>
                                                    <h5 id="total-prix">Prix total : <strong>5€</strong></h5>
                                                </div>
                                                <br/><br/>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i>Annuler</button>
                                                <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Vider mon panier</button>
                                                <button type="button" class="btn btn-primary"><i class="fas fa-save"></i>Sauvegarder</button>
                                                <button type="button" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Payer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                       
                        

                        

                            

                        <?php } else { ?>  
                             <!-- Boutons permettant la connexion / inscription -->
                        <ul class="nav navbar-nav navbar-right">
                          <li><a class="btn login " href="/connexion">Connexion</a><li>
                            <li><a class="btn btn-default action-button" role="button" href="/inscription">Inscription</a></li>
                        </ul>
                          <?php } ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>


@yield('content')

    

 
<footer class="footer-distributed">

<div class="footer-left">

    <h3>BDE</h3>

    <p class="footer-links">
        <a href="#">Accueil</a>
        ·
        <a href="#">Nous Contacter</a>
        ·
        <a href="#">Mentions Legales</a>
    </p>

    <p class="footer-company-name">BDE &copy; 2019</p>
</div>

<div class="footer-center">

    <div>
        <i class="fa fa-map-marker"></i>
        <p><span>2 Allée des Foulons, 67380</span> Strasbourg Lingolsheim, France</p>
    </div>

    <div>
        <i class="fa fa-phone"></i>
        <p>+33 6 28 01 48 23</p>
    </div>

    <div>
        <i class="fa fa-envelope"></i>
        <p><a href="mailto:bde@cesi.fr">bde@cesi.fr</a></p>
    </div>

</div>

<div class="footer-right">

    <p class="footer-company-about">
        <span>A propos du BDE</span>
        On vole les A1
    </p>

    <div class="footer-icons">

        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>

    </div>

</div>

</footer>

    
    
    

</html>