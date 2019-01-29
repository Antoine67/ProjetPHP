@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/boutique_article.css') }}">

<!-- Fonctions de tris -->
<script src="{{ asset('/js/boutique_categorie.js') }}"></script>

<span hidden id="id-article"><?=$id_article?></span>
<span hidden id="csrf-token"><?=csrf_token() ?></span>

<?php 

use App\Article;
use App\Panier;

//Récuperer l'url 
$protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
$url = $protocol . $_SERVER['SERVER_NAME'];

//Si il y a port specifique (ex:localhost:8000)
if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

$url=$url . '/';





$articles = Article::where('ID',$id_article)->get();
if(sizeof($articles) <=0) {
    
    echo 'Article non trouvé :(';
}
else {
    $article = $articles[0]; // On ne garde que le 1er element (l'id est unique !);
    if($article['Stock'] == 0) {
        $stock = '<span style="color:red;">Rupture momentanée de stock</span> ';
    }else {
        $stock = $article['Stock'] . ' disponibles';
    }


    echo '

    <div class="text-center">';
    if(Session::get('role') == 2) { 
        echo '<a id="suppr-article" class="btn btn-default butt" role="button">Supprimer l\'article</a><hr>';
    }
        echo '
<div class="container-fluid container">
    <div class="col-lg-12 col-md-12 col-sm-12 categories">
        <h2 class = "titre"> '. $article['Nom'] .' </h2>
        <div class="col-lg-12 col-md-12 col-sm-12 diffidee">

                <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                    <img class="img" src="'. $url . $article["Image"] .'" alt="Objet1" >
                </div>

                <div class="col-lg-10 col-md-10 col-sm-10 description">
                    <p class="texte-description">' . $article['Description'] . '</p>
                    
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 ajout-panier">
                
                <p class="prix"><span >' . $article['Prix'] . '</span> €</p>
                <h5> '. $stock .' </h5>
                    
                ';
            if($article['Stock'] != 0) {
                $user = Session::get('role');
                if(!isset($user)){
                    echo'<a href="/connexion" >Connectez-vous pour procéder à l\'ajout au panier</a>
                    ';
                }
                else{
                    echo'
                        <button class="btn btn-success" id="ajout-panier" data-toggle="modal" data-target="#ajouter-article-panier">Ajouter au panier</button>
                        ';
                }
                
            } 
        echo'
                </div>
        </div>
    </div>
    </div>';
}

?>

<script src="{{ asset('/js/boutique_article.js') }}"></script>

<?php
//Si l'article existe bien
if(sizeof($articles) >0 && $article['Stock'] >0) {
    ?>
<!-- Mini-fenêtre (modal) -->
<div class="modal fade" id="ajouter-article-panier" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="titre-modal-photo">Ajouter un article au panier</h3>
            </div>

            <!-- Article à ajouter au panier -->
            <div class="modal-body basket-content text-center">
                    
                <form action="/boutique/article" method="post">
                    @csrf
                    <input type="hidden" id="id-article-modal" name="id-article" value="<?=$article["ID"]?>">
                    <img id="article-img-modal" alt="Image article" src="<?= $url . $article["Image"] ?>">
                    <h2 id="article-nom-modal"><?=$article["Nom"]?></h2>
                    <h3>Prix unitaire : <span id="article-prix-modal"><?=$article["Prix"]?></span>€</h3>
                    <label  for="qte-cmd">Quantité :</label>
                    <input id="qte-cmd" name="quantite" placeholder="Quantité" value="1">
                    <hr class="delimiteur">
                    <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i>Ajouter au panier</button></div>
                  </form>       
              </div>

         </div>
     </div>
 </div>


<?php } 

echo '</div>';?>






@endsection