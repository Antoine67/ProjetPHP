@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/boutique_categorie.css') }}">
<script src="{{ asset('/js/boutique_categorie.js') }}"></script>
<?php 

use App\Categorie;
use App\Article;


//Récuperer l'url 
$protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
$url = $protocol . $_SERVER['SERVER_NAME'];

//Si il y a port specifique (ex:localhost:8000)
if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

$url=$url . '/';


$categorie = strtolower($categorie);
$categorie_existe = Categorie::where('Nom',$categorie)->get();


if(sizeof($categorie_existe) <=0) {
    echo 'Catégorie non trouvée :(';
}else {
    
    $articles = Article::select('Articles.*','Categories.Nom as Categorie')->orderBy('Prix','ASC')
    ->join('Categories', 'Articles.ID_Categories', '=', 'Categories.ID')
    ->where('ID_Categories',$categorie_existe[0]['ID'])
    ->get();

    //Titre catégorie
    echo '<div class="container-fluid container"> <h1>' . ucfirst($categorie) .'</h1><hr/> </div>';



    //Filtres / Tris 
    ?>
    <div class="container-fluid container">
        <span> <i class="fas fa-filter img3"></i> Trier par :</span>
        <button class="btn btn-light classer" value="Nom">Nom</button>
        <button class="btn btn-light classer" value="Prix">Prix</button>
    </div>
    <?php

    if(sizeof($articles)>0) {
        echo '<div class="container text-center articles">';
        foreach ($articles as $article) {       

            echo '
            <div class="article"><a href="/boutique/article/'.$article['ID'].'">
                <span hidden class="id-article">'.$article['ID'].'</span>
                        <div class="image-container">
                            <img class="image img-article" src="'. $url . $article["Image"] .'" alt="Objet1" >
                        </div>
                    <p class="nom-article">'.$article['Nom'].'</p>
                    <span class="prix-article">'.$article['Prix'].'</span>€
                    </a></div>';
        }
        echo '</div>';
    }else {
        echo 'Aucun article dans cette catégorie actuellement';
    }
}

?>

@endsection