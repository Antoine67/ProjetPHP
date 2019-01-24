@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/activite_specifique.css') }}">
<span hidden id="csrf-token"><?=csrf_token() ?></span>
<span hidden id="id-activite"><?=$id_activite?></span>

<?php

use App\Activite;
use App\Like;
use App\ImageActivite;
use App\Avis;
use App\Inscription;
use App\CommentaireImage;

use Illuminate\Support\Facades\DB;



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
    
    
   
?>


<div class="container"> 
    <div class="row">
        <h1> <?=$activite_data['Titre']?> </h1>
        <hr class="hr2">
        <div>
        <?php 
        


        $inscritThisOne = Inscription::where('ID_Utilisateurs', Session::get('id'))->where('ID_Activites', $id_activite)->get(); 
        if(sizeof($inscritThisOne) != 0) { // On determine si l'utilisateur est déjà inscrit ou non
            $class=' active';
            $inscrit = '<i class="fas fa-check"></i>  Inscrit ';
        }else {
            $class='';
            $inscrit = 'S\'inscrire';
        }
        $inscriptionClass = 'btn btn-default butt' . $class;


        $dateActuelle = new DateTime();
        $date = new DateTime($activite_data['Date']);

        ?>
        <div class="text-center">
            <?php 
            if($date < $dateActuelle) {
                ?>
            <a class="<?=$inscriptionClass?>" role="button" id="inscription-activite"><?=$inscrit?></a>
            <?php } ?>

            <a class="btn btn-default butt" role="button" data-toggle="modal" data-target="#liste-inscrits">Liste des inscrits</a>
            <a class="btn btn-default butt" role="button" data-toggle="modal" data-target="#ajouter-photo">Ajouter des photos</a>
        </div>
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
                    
                        <form action="/activites/<?=$id_activite?>" method="post" enctype="multipart/form-data">
                            @csrf
                            Selectionnez l'image que vous souhaitez ajouter à cette activité :
                            <input type="file" class="btn btn-primary" name="fichier" >
                            <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Ajouter</button></div>
                        </form>       
                    </div>
                </div>
            </div>
        </div>

         <!-- Mini-fenêtre (modal) -->
         <div class="modal fade" id="liste-inscrits" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title" id="titre-modal-inscrits">Listes des inscrits</h3>

                    </div>

                    <!-- Liste des inscrits -->
                    <div class="modal-body basket-content">
                    <?php 
                    
                    $inscrits = Inscription::where('ID_Activites',$id_activite)->get();

                    try {
                        $bdd = DB::connection('mysql2')->getPdo();
                    } catch(Exception $e) {

                    }
                    if(sizeof($inscrits) > 0) {
                        echo '<ul>';
                        foreach ($inscrits as $inscrit) {
                            $reponse = $bdd->prepare('SELECT Nom, Prenom FROM utilisateurs WHERE id=:id');
                            $reponse->bindValue(':id', $inscrit['ID_Utilisateurs'], $bdd::PARAM_STR);
                            $reponse->execute();
                            if($donnee=$reponse->fetch()){
                            echo '<li>'.$donnee['Nom'] . ' ' .$donnee['Prenom'] .'</li>';
                            }
                        }
                        echo '</ul>';
                    }else {
                        echo 'Aucun inscrit';
                    }
                    
                    ?>
                        
                    </div>

                </div>
            </div>
        </div>







        <?php 

        $prix = $activite_data['Prix'] ;
        if($prix<=0)  $prix = 'Gratuit'; else $prix = $prix . '€';

        $date = date("d-m-Y", strtotime($activite_data['Date_realisation']));
        $date = str_replace('-',' / ',$date);


        ?>



        <div class="container-fluid container">
            <div class="col-lg-12 col-md-12 col-sm-12 categories">
                <h2 class = "titre">Description de l'activité :</h2>
                <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                    <div class="col-lg-10 col-md-10 col-sm-10 idee">
                        <p class="left"><?=$activite_data['Description']?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 categories">

                <h2 class = "titre">Informations supplémentaires :</h2>
                <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                    <div class="col-lg-10 col-md-10 col-sm-10 idee">
                        <h3>Prix : <strong><?=$prix?></strong></h3>
                        <h3>Date : <strong><?=$date?></strong></h3>
                    </div>
                </div>
            </div>
        </div>



                <?php 
        
                //----------------------------------//
                // ------- IMAGES ACTIVITES ------- //
                //----------------------------------//

                $images_activites = ImageActivite::where('ID_Activites', $id_activite)->get();

                if(sizeof($images_activites)!=0) {
                    
                    //On affiche toutes les images associées à cette activité ainsi que les likes
                    echo '<div class="images text-center">';
                    foreach ($images_activites as $activite) {

                        //Determiner si liké ou non
                        $nb_likes=sizeof(Like::where('ID_Image_activites', $activite['ID'])->get());
                        $likeThisOne = Like::where('ID_Utilisateurs', Session::get('id'))->where('ID_Image_activites', $activite['ID'])->get();
                        $class = sizeof($likeThisOne) != 0 ? "active" : "";  // On determine si l'utilisateur a liké ou non ce contenu

                        //Récuperer les commentaires de chaque image 
                        $comms = CommentaireImage::where('ID_Image_activites', $activite['ID'])->get();
                       

                        echo '<div class="image-container ">
                                <div class="img-chat">
                                    <img class="image-activite" src="'. $url . $activite["Image"] .'" alt="Image de l\'activité" > 
                                    <div class="commentaires-image">';
                                    foreach ($comms as $comm) {
                                        $nomUtilisateur = "Inconnu";
                                        try {
                                            $reponse = $bdd->prepare('SELECT Nom, Prenom FROM utilisateurs WHERE id=:id');
                                            $reponse->bindValue(':id', $comm['ID_Utilisateurs'], $bdd::PARAM_STR);
                                            $reponse->execute();
                                            
                                            if($donnee = $reponse->fetch()) {
                                                $nomUtilisateur = strtoupper($donnee['Nom']) . ' ' . ucfirst($donnee['Prenom']);
                                            }
                                        } catch(Exception $e) {
                                            
                                        }

                                        echo '<p class="commentaire-image">['.$nomUtilisateur.']:<br/>'.$comm['Contenu'].'</p>';
                                    }

                        echo'       </div>
                                </div>
                                <div class="like">
                                            <p class="like-texte" data-id='.$activite['ID'].'>'. $nb_likes .'</p> <i class="fas fa-thumbs-up upvote '. $class .'" role="button"></i>
                                        </div> 
                                <div class="ecrire-commentaire-image" style="visibility:hidden">
                                    <p style="float:right;padding-top:5px;font-size:20px;">
                                        Un commentaire ? Un avis ?
                                    </p>
                                    <textarea placeholder="Votre commentaire"></textarea>
                                    <span hidden class="id-activite" value="'.$activite['ID'].'"></span>
                                    <button class="btn btn-success envoyer-commentaire-image">Envoyer</button>  
                                </div>
                                
                            </div>'; 
                        
                        
                    }
                    echo '</div>'; // Fin div "images"

                }else {
                    echo '<div class="no-image">
                            Aucune image associée à cette activité<br/>
                            <strong>Soyez le premier à en poster une !</strong>
                          </div>';
                }

                //-------------------------------//
                // ------- AVIS ACTIVITE ------- //
                //-------------------------------//

                $avis_activites = Avis::where('ID_Activites', $id_activite)->get();

                echo '<div class="commentaires text-center">';

                date_default_timezone_set('Europe/Paris');
                if(sizeof($avis_activites)!=0) {
                    foreach ($avis_activites as $avis) {

                        $date = $avis['Date_creation'] ;
                        $dateActuelle = date("Y-m-d H:i:s");
                        $datetime1 = new DateTime($dateActuelle);
                        $datetime2 = new DateTime($date);

                        $intervalle = $datetime1->diff($datetime2);

                        //Depuis combien de temps à été ecrit ce commentaire
                        if($intervalle->format('%R%a')<1) {
                            $diff='aujourd\'hui';
                        }else if ($intervalle->format('%R%a')==1){
                            $diff=$intervalle->format('hier');
                        }else {
                            $diff = $intervalle->format('%R%a jours');
                        }
                        
                        $nomUtilisateur = "";
                        try {
                            $reponse = $bdd->prepare('SELECT Nom, Prenom FROM utilisateurs WHERE id=:id');
                            $reponse->bindValue(':id', $avis['ID_Utilisateurs'], $bdd::PARAM_STR);
                            $reponse->execute();
                            
                            if($donnee = $reponse->fetch()) {
                                $nomUtilisateur = strtoupper($donnee['Nom']) . ' ' . ucfirst($donnee['Prenom']);
                            }
                        } catch(Exception $e) {
                            echo $e;
                        }


                        echo '<div class="commentaire"><div class="panel panel-default"><div class="panel-heading">';
                        echo '<strong>'.$nomUtilisateur .'</strong> <span class="text-muted">posté '.$diff.'</span></div>';
                        echo '<div class="panel-body">'.$avis['Contenu'].'</div></div></div>';
                    }
                }else {
                    echo 'Aucun commentaire pour cette activité';
                }
                echo '</div>' // Fin div "commentaires
                
                ?>  


                <hr/>
                <form method="post" action="/activites/<?=$id_activite?>">
                @csrf
                    <div class="form-group">
                        <label for="votre-commentaire">Partagez votre avis sur cette activité :</label>
                        <textarea name="commentaire" class="form-control" style="resize: none;" rows="5" placeholder="Ecrire un commentaire..." id="votre-commentaire"></textarea>
                    </div>
                    <div class="right"><button type="submit" class="btn btn-success submit-commentaire">Envoyer</button></div>
                </form>
        </div>
    </div>
    
</div>
<script src="{{ asset('/js/activite_specifique.js') }}"></script>

<?php }//Fin du else activité existante ?>
@endsection