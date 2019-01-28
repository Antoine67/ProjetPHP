@extends('layout')


@section('content')
<link rel="stylesheet" href="{{ asset('/css/recherche.css') }}">
<link rel="stylesheet" href="{{ asset('/css/boutique_categorie.css') }}">

<script src="{{ asset('/js/boutique.js') }}"></script>

<?php 
use App\Article;
$article_data = Article::select('Articles.*','Categories.Nom as Categorie')
->join('Categories', 'Articles.ID_Categories', '=', 'Categories.ID')
->get();

echo '
        <script>
            var liste = [';
            foreach($article_data as $ar) {
                echo'"'.$ar['Nom'].'",';
            }
            echo'
                ];
        </script>'; ?>


<link rel="stylesheet" href="{{ asset('/css/jquery-ui.structure.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/jquery-ui.theme.min.css') }}">
<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/js/recherche.js') }}"></script>



<div class="container-fluid text-center container">
    <div class="recherche_p">
        <form action="/recherche" id="searchthis" method="get">
            <input id="search" name="article" type="text" placeholder="Rechercher" required/>
            <input id="search-btn" type="submit" value="Rechercher" />
        </form>
    </div>
</div>



<?php 

$rechercheTerme = $_GET['article'];

if(!isset($rechercheTerme)){

}else {
    
        //Récuperer l'url
        $protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
        $url = $protocol . $_SERVER['SERVER_NAME'];

        //Si il y a port specifique (ex:localhost:8000)
        if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

        $url=$url . '/';



        $articles = Article::select('Articles.*')
        ->where('Nom','LIKE',"%{$rechercheTerme}%")
        ->get();

        //Titre catégorie
        echo '<div class="container-fluid container"> <h1> Recherches correspondants à "' . ucfirst($rechercheTerme) .'"</h1><hr/> </div>';


        

        if(sizeof($articles)>0) {
          
            //Filtres / Tris 
            ?>
            <div class="container-fluid container">
                <span> <i class="fas fa-filter img3"></i> Trier par :</span>
                <button class="btn btn-light classer" value="Nom">Nom</button>
                <button class="btn btn-light classer" value="Prix">Prix</button>
            </div>
            <?php
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
           
        }else {
            echo '<div class="container text-center articles">';
            echo '<h3>Aucun article ne correspond ! Essayer d\'affiner votre recherche</h3>';
        }
        echo '</div>';
}





?>



@endsection
