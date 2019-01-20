@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/activite_specifique.css') }}">
<meta name="csrf-token" content="<?php echo csrf_token() ?>"> 

<?php

use App\Activite;
use App\Like;
use App\ImageActivite;


$activite_data = Activite::find($id_activite);
if(!isset($activite_data)) {
    echo "<h1>Impossible de trouver l'activité demandée</h1>";
}else { 

//URL sur laquelle il faut cherche les images
    //Protocle (HTTP/HTTPS)
    $protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
    $url = $protocol . $_SERVER['SERVER_NAME'];

    //Si il y a port specifique (ex:localhost:8000)
    if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

    $url=$url . '/';
    
    
   

//{"ID":1,"Titre":"Activit\u00e9 Test!","Prix":5,"Image":"image_site\/activites","Description":"Description test","Date_realisation":"2019-01-20","Date_creation":"2019-01-20","ID_Utilisateurs":1}

?>
<div class="container text-center"> 

    <div class="row">
    <h1> <?=$activite_data['Titre']?> </h1>
    <hr class="hr2">
        <div>
        <a class="btn btn-default action-button butt" role="button" href="/inscription">S'inscire à l'activité</a>
        <a class="btn btn-default action-button butt" role="button" href="/inscription">Liste des inscrits</a>
        <a class="btn btn-default action-button butt" role="button" data-toggle="modal" data-target="#ajouter-photo">Ajouter des photos</a>

        <!-- Mini-fenêtre (modal) -->
        <div class="modal fade" id="ajouter-photo" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title" id="titre-modal-photo">Ajouter des photos</h3>

                    </div>

                    <!-- Panel pour ajouter des photos -->
                    <div class="modal-body basket-content">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            Selectionnez l'image que vous souhaitez ajouter à cette activité :
                            <input type="file" class="btn btn-primary" name="file">
                            <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Ajouter</button></div>
                        </form>           
                    </div>

                </div>
            </div>
        </div>





            <div>
                <h2><br/>Description de l'activité :</h2>   
                <p><?=$activite_data['Description']?></p>       
            </div>

                <?php 
                
                //$images_activites = ImageActivite::where('ID_Activites', '=',$id_activite);
                $images_activites = ImageActivite::where('ID_Activites', '=', $id_activite)->get();

                if(sizeof($images_activites)!=0) {
                    
                    //On affiche toutes les images associées à cette activité
                    echo '<div class="images">';
                    foreach ($images_activites as $activite) {

                        echo '<div class="image-container">';
                        echo '<img class="image-activite" src="'. $url . $activite["Image"] .'" alt="Image de l\'activité" > ';

                        $nb_likes=sizeof(Like::where('ID_Image_activites', $activite['ID'])->get());
                        

                        echo '<div class="like">';

                        $likeThisOne = Like::where('ID_Utilisateurs', Session::get('id'))->where('ID_Image_activites', $activite['ID'])->get();
                        $class = sizeof($likeThisOne) != 0 ? "active" : "";  // On determine si l'utilisateur a liké ou non ce contenu
                        echo '<p class="like-texte" data-id='.$activite['ID'].'>'. $nb_likes .'</p> <i class="fas fa-thumbs-up upvote '. $class .'" role="button"></i>';
                        


                        echo '</div></div>'; // Fin div "image-container" et "like"
                        
                    }
                    echo '</div>'; // Fin div "images"

                }else {
                    echo '<div class="no-image">
                            Aucune images associées à cette activité<br/>
                            <strong>Soyez le premier à en poster une !
                          </div>';
                }

                
                ?>  



            <div>
               

                <div class="commentaire">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Bada</strong> <span class="text-muted">il y a 5 jours</span>
                        </div>

                        <div class="panel-body">
                            C'est vraiment trop bien le foot wtf
                        </div><!-- /panel-body -->
                    </div><!-- /panel panel-default -->
                </div><!-- /col-sm-5 -->

                <div class="commentaire">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Pique</strong> <span class="text-muted">il y a 2 jours</span>
                        </div>

                        <div class="panel-body">
                            Wow
                        </div><!-- /panel-body -->
                    </div><!-- /panel panel-default -->
                </div><!-- /col-sm-5 -->
                <hr/>
                <form>
                    <div class="form-group">
                        <label for="votre-commentaire">Vous avez participé à cette activité ? <br/>Partager votre avis sur cette activité :</label>
                        <textarea class="form-control" style="resize: none;" rows="5" placeholder="Ecrire un commentaire..." id="votre-commentaire"></textarea>
                    </div>
                    <div class="right"><button type="submit" class="btn btn-success submit-commentaire">Envoyer</button></div>
                </form>
                
            </div>
        </div>
    </div>
    
</div>
<script src="{{ asset('/js/activite.js') }}"></script>

<?php }//Fin du else activité existante ?>
@endsection