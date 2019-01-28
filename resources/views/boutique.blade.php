@extends('layout')

@section('content')


<link rel="stylesheet" href="{{ asset('/css/boutique.css') }}">
<link rel="stylesheet" href="{{ asset('/css/recherche.css') }}">




<script src="{{ asset('/js/recherche.js') }}"></script>

<?php

use App\Article;
use App\Panier;
use App\Categorie;

use Illuminate\Support\Facades\DB;



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


<?php
if(isset($message)) {
    echo '<div class="alert alert-success message-succes">'.$message.'<span id="close-message"><i class="fas fa-times-circle"></i></span></div>';
}?>

<div class="container-fluid text-center container">
    <div class="center">
        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-article">Ajouter un produit</a>
        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-categorie">Ajouter une catégorie</a>
    </div>



    <?php
   $liste_categories = array();
   $cats_all = Categorie::all();
   foreach ($cats_all as $cat) {
       array_push($liste_categories,$cat['Nom']);
   }
    ?>

    <!--Ajout un produit -->
    <div class="modal fade" id="ajouter-article" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

                    <h3 class="modal-title" >Ajouter un article</h3>

                </div>

                <!-- Panel Ajout activités -->
                <div class="modal-body basket-content">
                    
                    <form class="form-act" action="/boutique" method="post" enctype="multipart/form-data">
                        @csrf

                        <label><b>Nom du produit :</b></label>
                        <input type="text" name="nom" required>
                    

                        <label><b>Description</b></label>
                        <textarea name="description" required></textarea>


                        <label><b>Prix</b></label>
                        <input type="text" name="prix" required>
              
                        <label><b>Quantité disponible</b> </label>
                        <input type="text" name="quantité" required>

                        <label><b>Catégorie</b> </label>
                        <select name="categorie" required>
                        <option value="" selected disabled>Catégorie </option>
                            <?php 
                            foreach ($cats_all as $cat) {
                                $min = strtolower($cat['Nom']);
                            echo '<option value="'. $cat['ID'] .'">'. $cat['Nom'] .'</option>';
                            }
                            
                            ?>
                        </select>
 

                        <label><b>Image de ce produit :</b></label>
                        <input type="file" class="btn btn-primary" name="fichier" required>



                        <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Ajouter</button></div>
                    </form>       
                </div>

            </div>
        </div>
    </div>


<!--Ajout une catégorie -->
<div class="modal fade" id="ajouter-categorie" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>

                <h3 class="modal-title" >Ajouter une catégorie</h3>

            </div>

            <!-- Panel Ajout catégorie -->
            <div class="modal-body basket-content">
                    
                <form class="form-act" action="/boutique" method="post" enctype="multipart/form-data">
                    @csrf

                    <label><b>Nom de la catégorie :</b></label>
                    <input type="text" name="creation_categorie" required>

                    <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Ajouter</button>
                    </div>
                </form>       
            </div>
        </div>
    </div>
</div>


    <hr>
    <h1>Notre boutique</h1>

    <div class="recherche_p">

    <link rel="stylesheet" href="{{ asset('/css/jquery-ui.structure.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jquery-ui.theme.min.css') }}">
    <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
    <?php echo'
    <script>
        var liste = [';
        foreach($article_data as $ar) {
            echo'"'.$ar['Nom'].'",';
        }
        echo'
            ];
    </script>';
    ?>
 

        <form action="/recherche" id="searchthis" method="get">
            <div class="recherche-div">
                <input id="search" name="article" type="text" placeholder="Rechercher" required/>
                <input id="search-btn" type="submit" value="Rechercher" />
            </div>
        </form>

    </div>

    <div class="container-fluid text-center container"> 
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h2>Naviguer parmis nos différentes catégories : </h2>
            <br>
        </div>
    </div>

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
                echo'<li><a href="/boutique/'.$categ_nom.'" class="btn button_categories" ><p class="bk_text"> '.$categ['Nom'].' </p></a></li>';
            }
            
            
            
            ?>
        </ul>
    </div>







    <hr>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div>
                <h2 class="hiddenz" id="best">Nos meilleures ventes: </h2>
                <br>
            </div>
        </div>
</div>

<!-- Meilleures ventes -->

<div class="row1">
    <div class="container-fluid text-center container article_container">
    <?php 

        $article_data = Article::select('Articles.*','Categories.Nom as Categorie')->orderBy('Vendu','DESC')
        ->join('Categories', 'Articles.ID_Categories', '=', 'Categories.ID')
        ->get();

        

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
                   
                    echo '<a class = "containerz" href="/boutique/article/'.$article['ID'].'">';
                        echo '<div class="imagetexte" value="'.$article['ID'].'">';
                            echo '<h2 class="nom-article">'.$article['Nom'].'</h2>';
                            echo'<span hidden class="id-article">'.$article['ID'].'</span>';
                                echo '<img class="image2 img-article" src="'. $url . $article["Image"] .'" alt="Objet1" >';
                                echo '<h2 class="taille-prix"><span class="prix-article">'.$article['Prix'].'</span>€</h2>';
                            echo '</div>';
                        echo '</div>';
                   
                     echo '</a>';

                $nb_articles++;
                if($nb_articles>=$nb_max_articles) break; //On affiche uniquement le nombre souhaité d'articles dans les meilleures ventes

            }
        }else {
            echo 'Aucun article trouvé !';
        }

        
        ?>  

    </div>
</div>


<br/><br/><br/><br/><br/><br/>
   

    </div>
</div>

<?php }//Fin du else  ?>

@endsection
