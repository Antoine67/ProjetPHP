@extends('layout')

@section('content')


<link rel="stylesheet" href="{{ asset('/css/boutique.css') }}">

<?php

use App\Article;
use App\Panier;

use Illuminate\Support\Facades\DB;


$article_data = Article::orderBy('Categorie')->get();
if(!isset($article_data)) {
    echo "<h1>Il n'y a aucun article/h1>";
}else { 
        $protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
    $url = $protocol . $_SERVER['SERVER_NAME'];

    //Si il y a port specifique (ex:localhost:8000)
    if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

    $url=$url . '/';

?>

<div class="container-fluid text-center container">
    <hr>
    <h1>Notre boutique</h1>

        <div class="recherche_p">

            <form action="/search" id="searchthis" method="get">
                <input id="search" name="q" type="text" placeholder="Rechercher" />
                <input id="search-btn" type="submit" value="Rechercher" />
            </form>

        </div>
    <hr>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div>
                <h2  class="hiddenz" id="best">Nos meilleures ventes: </h2>
            </div>
        </div>


<div class="row1">

<?php 
    $article_data = Article::orderBy('Vendu','DESC')->get();

    echo '<a href="/idees">';

    if(sizeof($article_data)!=0) {
        $nb_articles= 0;
        $nb_max_articles = 3;
        foreach ($article_data as $article) { 
            echo '<div class="col-lg-4 col-md-6 col-sm-6 produit">';
            echo '<h2>'.$article['Nom'].'</h2>';
            echo '<img id="topobjet1" src="'. $url . $article["Image"] .'" alt="TopObjet1">';
            echo '<h2>'.$article['Prix'].'€</h2>';
            echo '</div>';
            $nb_articles++;
            if($nb_articles>=$nb_max_articles)
            {
                break;
            }
        }
    }else {
        echo 'Aucun commentaire';
    }
    echo '</a>' // Fin div "commentaires
    
    ?>  


</div>
<div class="container-fluid text-center container"> 
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h2 id="best2">Tous nos produits: </h2>
    </div>
</div>


<div class="container-fluid text-center container">

    <div id="menu">

        <ul id="onglets">
            <div class = "gauche">
                <div class="dropdown"><a class="dropdown-toggle username" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"> <i class="fas fa-filter img3"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a href="#">Nom</a></li>
                        <li role="separator" class="divider"></li>
                        <li role="presentation"><a href="/deconnexion">Prix</a></li>
                        <li role="separator" class="divider"></li>
                        <li role="presentation"><a href="/deconnexion">Catégorie</a></li>
                    </ul>
                </div>
            </div>
            <li class="active"><a href=""> Matériels informatiques </a></li>
            <li class="active"><a href=""> Vêtements </a></li>
            <li class="active"><a href=""> Accessoirs </a></li>
            <li class="active"><a href=""> Autres </a></li>
        </ul>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class = "gauche">
            <a href="/idees">
                <i class="fas fa-plus-square"></i>
            </a>
        </div>
    </div>

    <div class="row1">

        <div class="col-lg-2 col-md-5 col-sm-4 ">
            <a href="/idees">
                <div class="produit">
                    <p>Objet 1</p>
                    <img id="objet1" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet1">
                    <p>Prix: 5€</p>
                </div>
            </a>
            <a href="/idees">
                <i class="fas fa-edit"></i>
            </a>
            <a href="/idees">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4 ">
            <a href="/idees">
                <div class="produit">
                    <p>Objet 2</p>
                    <img id="objet2" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet2">
                    <p>Prix: 5€</p>
                </div>
            </a>
            <a href="/idees">
                <i class="fas fa-edit"></i>
            </a>
            <a href="/idees">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4 ">
            <a href="/idees">
                <div class="produit">
                    <p>Objet 3</p>
                    <img id="objet3" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet3">
                    <p>Prix: 5€</p>
                </div>
            </a>
            <a href="/idees">
                <i class="fas fa-edit"></i>
            </a>
            <a href="/idees">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4 ">
            <a href="/idees">
                <div class="produit">
                    <p>Objet 4</p>
                    <img id="objet4" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet4">
                    <p>Prix: 5€</p>
                </div>
            </a>
            <a href="/idees">
                <i class="fas fa-edit"></i>
            </a>
            <a href="/idees">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4 ">
            <a href="/idees">
                <div class="produit">
                    <p>Objet 5</p>
                    <img id="objet5" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet5">
                    <p>Prix: 5€</p>
                </div>
            </a>
            <a href="/idees">
                <i class="fas fa-edit"></i>
            </a>
            <a href="/idees">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4 ">
            <a href="/idees">
                <div class="produit">
                    <p>Objet 6</p>
                    <img id="objet6" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet6">
                    <p>Prix: 5€</p>
                </div>
            </a>
            <a href="/idees">
                <i class="fas fa-edit"></i>
            </a>
            <a href="/idees">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </div>
</div>

<?php }//Fin du else activité existante ?>

@endsection
