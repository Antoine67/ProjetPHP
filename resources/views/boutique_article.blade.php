@extends('layout')

@section('content')

<?php 

use App\Article;
use App\Panier;

//Récuperer l'url 
$protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
$url = $protocol . $_SERVER['SERVER_NAME'];

//Si il y a port specifique (ex:localhost:8000)
if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

$url=$url . '/';



$article = Article::find($id_article);


if(sizeof($article) <=0) {
    echo 'Article non trouvé :(';
}else {
    echo '
    <div id="article">
        <img class="image2 img-article" src="'. $url . $article["Image"] .'" alt="Objet1" >
    <h1>' . $article['Nom'] . '</h1>
        <button class="btn" id="ajout-panier" data-toggle="modal" data-target="#ajouter-article-panier">Ajouter au panier</button>
    </div>
    ';
}

?>

<script src="{{ asset('/js/boutique_article.js') }}"></script>

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








@endsection