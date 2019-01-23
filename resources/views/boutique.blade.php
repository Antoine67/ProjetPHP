@extends('layout')

@section('content')


<link rel="stylesheet" href="{{ asset('/css/boutique.css') }}">

<script src="{{ asset('/js/boutique.js') }}"></script>

<?php

use App\Article;
use App\Panier;
use App\Categorie;

use Illuminate\Support\Facades\DB;

//$article_data = Article::orderBy('Categorie')->get();

$article_data = Article::select('Articles.*','Categories.Nom as Categorie')
->join('Categories', 'Articles.ID_Categories', '=', 'Categories.ID')
->get();

if(!isset($article_data)) {
    echo "<h1>Il n'y a aucun article/h1>";
}else { 
    $protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
    $url = $protocol . $_SERVER['SERVER_NAME'];

    //Si il y a port specifique (ex:localhost:8000)
    if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

    $url=$url . '/';

?>
<span hidden id="csrf-token"><?=csrf_token() ?></span>

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
                    
                <form action="/boutique" method="post" >
                    @csrf
                    <input type="hidden" id="id-article-modal" name="id-article">
                    <img id="article-img-modal" alt="Image article" src="/none">
                    <h2 id="article-nom-modal"></h2>
                    <h3>Prix unitaire : <span id="article-prix-modal"></span>€</h3>
                    <label  for="qte-cmd">Quantité :</label>
                    <input id="qte-cmd" name="quantite" placeholder="Quantité" value="1">
                    <hr class="delimiteur" >
                    <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i>Ajouter au panier</button></div>
                  </form>       
              </div>

         </div>
     </div>
 </div>
<?php
if(isset($message)) {
    echo '<div class="alert alert-success message-succes">'.$message.'<span id="close-message"><i class="fas fa-times-circle"></i></span></div>';
}?>

<div class="container-fluid text-center container">
    <div class="center">
        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-article">Ajouter un produit</a>
    </div>


    <!-- Mini-fenêtre (modal) Ajout d'article -->
    <div class="modal fade" id="ajouter-article" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title" id="titre-modal-photo">Ajouter des photos</h3>

                    </div>

                    <!-- Panel pour ajouter des articles -->
                    <div class="modal-body basket-content">
                    
                        <form action="/boutique" method="post" enctype="multipart/form-data">
                            @csrf

                            <label  for="creation-nom-article">Nom :</label>
                            <input id="creation-nom-article">

                            
                            
                            Selectionnez l'image que vous souhaitez voir associer à cette article :
                            <input type="file" class="btn btn-primary" name="fichier" >
                            <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Ajouter</button></div>
                        </form>       
                    </div>

                </div>
            </div>
        </div>







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

        $article_data = Article::select('Articles.*','Categories.Nom as Categorie')->orderBy('Vendu','DESC')
        ->join('Categories', 'Articles.ID_Categories', '=', 'Categories.ID')
        ->get();

        echo '<a>';

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
                   
                    echo '<div class = "containerz">';
                        echo '<div class="imagetexte" value="'.$article['ID'].'">';
                            echo '<h2 class="nom-article">'.$article['Nom'].'</h2>';
                            echo'<span hidden class="id-article">'.$article['ID'].'</span>';
                                echo '<img class="image2 img-article" src="'. $url . $article["Image"] .'" alt="Objet1" >';
                                echo '<h2><span class="prix-article">'.$article['Prix'].'</span>€</h2>';
                        echo '</div>';
                    echo '</div>';
                   
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


<br/><br/><br/><br/><br/><br/>
<div class="container-fluid text-center container"> 
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h2>Naviguer parmis nos différentes catégories : </h2>
    </div>
</div>

<!-- Filtres / Boutons -->



    <div class="text-center">

        <ul id="categories">
            <?php 

            $caract_interdit = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
            


            $categories_all = Categorie::all();
            foreach($categories_all as $categ) {
                $categ_nom = strtr( $categ['Nom'], $caract_interdit );
                $categ_nom = strtolower($categ_nom);
                echo'<li><a href="/boutique/'.$categ_nom.'" class="btn" > '.$categ['Nom'].' </a></li>';
            }
            
            
            
            ?>
        </ul>
    </div>

    </div>
</div>

<?php }//Fin du else  ?>

@endsection
