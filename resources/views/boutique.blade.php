@extends('layout')

@section('content')


<link rel="stylesheet" href="{{ asset('/css/boutique.css') }}">

<script src="{{ asset('/js/boutique.js') }}"></script>

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
</div>

<!-- Meilleures ventes -->

<div class="row1">
    <div class="container-fluid text-center container">
    <?php 
        $article_data = Article::orderBy('Vendu','DESC')->get();

        echo '<a href="/idees">';

        if(sizeof($article_data)!=0) {
            $nb_articles= 0;
            $nb_max_articles = 3;
            foreach ($article_data as $article) { 
                if ($nb_articles == 2)
                {
                    echo '<div class="col-lg-4 col-md-12 col-sm-12 produit">';
                }
                else{
                    echo '<div class="col-lg-4 col-md-6 col-sm-6 produit">';
                }
                    echo '<h2>'.$article['Nom'].'</h2>';
                    echo '<div class = "containerz">';
                        echo '<div class="imagetexte">';

                            echo '<img class="image2" src="'. $url . $article["Image"] .'" alt="Objet1" >';
                            echo '<div class="text"></div>';

                        echo '</div>';

                    echo '</div>';
                    echo '<h2>'.$article['Prix'].'€</h2>';
                echo '</div>';

                $nb_articles++;
                if($nb_articles>=$nb_max_articles) break; //On affiche uniquement le nombre souhaité d'articles dans les meilleures ventes

            }
        }else {
            echo 'Aucun article trouvé !';
        }
        echo '</a>' 
        
        ?>  

    </div>
</div>



<div class="container-fluid text-center container"> 
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h2 id="best2">Tous nos produits: </h2>
    </div>
</div>

<!-- Filtres / Boutons -->

<div class="container-fluid text-center container">
        <ul class="nav navbar-nav ">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#"> <i class="fas fa-filter img3"></i><span class="caret"></span></a>
                <ul id="onglets" class="dropdown-menu" role="menu">
                    <li><a href="#">Nom</a></li>
                    <li><a href="#">Prix</a></li>
                </ul>
            </li>

        </ul>

        <div id="onglets">

            <ul id="onglets1">
                <li><button class="btn btn-light tri" data="materielinformatique"> Matériel informatique </button></li>
                <li><button class="btn btn-light tri" data="vetement"> Vêtement </button></li>
                <li ><button class="btn btn-light tri" data="accessoire"> Accessoire </button></li>
                <li><button class="btn btn-light tri" data="autre"> Autre </button></li>
            </ul >
        </div>



    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="gauche">
            <a href="/idees">
                <i class="fas fa-plus-square"></i>
            </a>
        </div>
    </div>


<!-- Tous les articles -->

    <div class="row1">

    <?php 

    $article_data = Article::orderBy('Categorie','ASC')->get();

    if(sizeof($article_data)!=0) {


        foreach ($article_data as $article) {       

            $cate = $article['Categorie'];

            $caract_interdit = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', ' '=>'' );
            $cate = strtr( $cate, $caract_interdit );
            $cate = strtolower($cate);

            echo '<div class="col-lg-3 col-md-5 col-sm-4 article '. $cate.'">';
                echo '<div class = "taille">';
                    echo ' <a href="/idees">';
                        echo '<div class="produit">';
                            echo '<p>'.$article['Nom'].'</p>';
                            echo '<div class = "image-container">';
                                echo '<img class="image" src="'. $url . $article["Image"] .'" alt="Objet1" >';
                            echo '</div>';
                            echo '<p>'.$article['Prix'].'€</p>';
                        echo '</div>';
                    echo '</a>';
                  
                        echo '<a class="fas fa-edit edit" href =""></a>';
                  
                        echo '<a class="fas fa-trash-alt" href =""></a>';
                  
                echo '</div>';
            echo '</div>';
        }
    }else {
        echo 'Aucun commentaire';
    }
    
    ?>  
    </div>
</div>

<?php }//Fin du else  ?>

@endsection
