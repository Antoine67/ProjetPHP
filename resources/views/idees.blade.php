@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/idees.css') }}">
<span hidden id="csrf-token"><?=csrf_token() ?></span>
<script src="{{ asset('/js/idee.js') }}"></script>

<?php

use App\Idee;
use App\Vote;

use Illuminate\Support\Facades\DB;

$util = Session::get('role');//Utilisateur connecté .. ou non

?>
<span hidden id="csrf-token"><?=csrf_token() ?></span>




<div class="container-fluid container"> 

<?php
    //URL sur laquelle il faut cherche les images
    //Protocle (HTTP/HTTPS)
    $protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
    $url = $protocol . $_SERVER['SERVER_NAME'];

    //Si il y a port specifique (ex:localhost:8000)
    if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

    $url=$url . '/';

    $util = Session::get('role');

    if(isset($util) && $util==2) { ?>
 
        <div class="text-center "><a class="btn btn-default butt upvote-button" role="button" data-toggle="modal" data-target="#liste-inscrits">Supprimer une idée</a></div>
        
        <!-- Mini-fenêtre (modal) -->
        <div class="modal fade" id="liste-inscrits" tabindex="-1" role="dialog" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span></button>

                       <h3 class="modal-title" id="titre-modal-inscrits">Listes des idées</h3>

                   </div>

                   <!-- Liste des inscrits -->
                   <div class="modal-body basket-content">
                   <?php 
                   
                   $idees_all = Idee::all();

                   
                   if(sizeof($idees_all) > 0) {
                       echo '
                       <table id="inscrit" class="display" style="width:100%" >
                           <thead>
                               <tr>
                                   <th>Nom</th>
                                   <th>Action</th>
                               </tr>
                           </thead>
                           <tbody>';
                           
                       foreach ($idees_all as $idee) {
                           echo '<tr><td>'.$idee['Titre'] . '</td><td class="suppresion-idee" id="suppr-idee-'.$idee['ID'].'">Supprimer</td></tr>';
                       }
                       echo '</tbody>
                       </table>';
                   }
                   
                   ?>
                       
                   </div>

               </div>
           </div>
       </div>
        
        

<?php } ?>
<div class="container-fluid container"> 
  <h1> La boîte à idées </h1>
  <hr/>
</div>
<?php

    $idees_proposees = Idee::orderby('Date_creation','ASC')->where('Etat',2)->get();
    $idees_acceptees = Idee::orderby('Date_creation','ASC')->where('Etat',3)->get();
    $idees_refusees = Idee::orderby('Date_creation','ASC')->where('Etat',1)->get();



    if(sizeof($idees_proposees)<=0) {
        echo '
        <div class="col-lg-12 col-md-12 col-sm-12 categories">
            <h2 class = "titre">Idées proposées</h2>
            <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                <div class="center">Aucune idée proposée
                </div>
            </div>
            <div>
                <label class="left">Vous avez une idée d\'activité à soumettre ?</label>
                <br/>
                <a class="btn btn-default button-activite envoyer" role="button" data-toggle="modal" data-target="#ajouter-idee">Partagez la !</a>
            </div>
        </div>
        
        ';
    }
    else {
        echo'
        <div class="col-lg-12 col-md-12 col-sm-12 categories">
        <h2 class = "titre">Idées proposées</h2>
        ';
        foreach($idees_proposees as $idee_proposee) {
            $nb_votes= sizeof(Vote::where('ID_Idees',$idee_proposee['ID'])->get());
            $liked_util = sizeof(Vote::where('ID_Idees',$idee_proposee['ID'])->where('ID_Utilisateurs',Session::get('id'))->get());
            $classe_bouton_like = $liked_util ? 'active' : '';

            echo '

            <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                <div class="titre-activite"> 
                    '. $idee_proposee['Titre'] .' 
                </div>

                <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                    <img class="img" src=' . $url . $idee_proposee['Image'] .' alt ="Image idée">
                </div>

                <div class="col-lg-10 col-md-10 col-sm-10 idee">
                    '.$idee_proposee['Contenu'].'
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 upvote">';
                if(isset($util)) {
                    echo'<a class="btn btn-default upvote-button icone '. $classe_bouton_like .'" role="button" id="vote-'.$idee_proposee['ID'].'">';
                
                }else{
                    echo '<a href="/connexion">Se connecter pour voter<br/>';
                }
                    echo'<i class="fas fa-angle-up"> '.$nb_votes.'</i>
                    </a>';
                    if(Session::get('role') == 2) {
                        echo '
                        <a class="btn btn-default check-button icone" role="button" id="vali-'.$idee_proposee['ID'].'"><i class="fas fa-check"></i></a>
                        <a class="btn btn-default ban-button icone" role="button"  id="refu-'.$idee_proposee['ID'].'"><i class="fas fa-ban"></i></a>';
                    }  
            echo'</div>    
            </div>
        
            ';
        } 
        echo '  <div>
                    <label class="left">Vous avez une idée d\'activité à soumettre ?</label>
                    <br/>
                    <a class="btn btn-default button-activite envoyer" role="button" data-toggle="modal" data-target="#ajouter-idee">Partagez la !</a>
                </div>
            </div>';
    }
  
        
    if(sizeof($idees_acceptees)<=0) {
        echo '
            <div class="col-lg-12 col-md-12 col-sm-12 categories" id="idee-acceptees">
                <h2 class = "titre">Idées acceptées</h2>
                <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                    <div class="center">Aucune idée n\'a été acceptée
                    </div>
                </div>
            </div>
            ';
        }
    else {
        echo ' 
        <div class="col-lg-12 col-md-12 col-sm-12 categories" id="idee-acceptees">
        <h2 class = "titre">Idées acceptées</h2>';
        foreach($idees_acceptees as $idee_acceptee) {
            $nb_votes= sizeof(Vote::where('ID_Idees',$idee_acceptee['ID'])->get());
            $liked_util = sizeof(Vote::where('ID_Idees',$idee_acceptee['ID'])->where('ID_Utilisateurs',Session::get('id'))->get());
            $classe_bouton_like = $liked_util ? 'active' : '';

            echo '

            <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                <div class="titre-activite"> 
                    '. $idee_acceptee['Titre'] .' 
                </div>

                <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                    <img class="img" src=' . $url . $idee_acceptee['Image'] .' alt ="Image idée">
                </div>

                <div class="col-lg-10 col-md-10 col-sm-10 idee">
                    '.$idee_acceptee['Contenu'].'
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 upvote">';
                if(isset($util)) {
                    echo'
                    <a class="btn btn-default upvote-button icone '. $classe_bouton_like .'" role="button" id="vote-'.$idee_acceptee['ID'].'">
                    ';
                }else {
                    echo '<a href="/connexion">Se connecter pour voter<br/>';
                }
                    
                    echo'   <i class="fas fa-angle-up"> '.$nb_votes.'</i>
                    </a>
                </div>    
            </div>';
        }echo ' </div>';
    }

        if(sizeof($idees_refusees)<=0) {
            echo '
            <div class="col-lg-12 col-md-12 col-sm-12 categories " id="idee-refusees" >
                <h2 class = "titre">Idées refusées</h2>
                <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                    <div class="center">Aucune idée n\'a été refusée
                    </div>
                </div>
            </div>
            ';
        }
        else {
            echo ' 
            <div class="col-lg-12 col-md-12 col-sm-12 categories" id="idee-refusees">
            <h2 class = "titre">Idées refusées</h2>';
            foreach($idees_refusees as $idee_refusee) {
                echo '
                <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                    <div class="left titre-activite"> 
                        '. $idee_refusee['Titre'] .' 
                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                    <img class="img" src=' . $url . $idee_refusee['Image'] .' alt ="Image idée">
                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-10 idee">
                        '.$idee_refusee['Contenu'].'
                    </div>
                </div>
            
                ';
            }echo '</div>';
            
            } ?>
            
    <!--Ajout activités -->
    <div class="modal fade" id="ajouter-idee" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title" >Ajouter une idée</h3>
                    </div>

                    <!-- Panel Ajout activités -->
                    <div class="modal-body basket-content">
                        
                        <form class="form-act" action="/idees" method="post" enctype="multipart/form-data">
                            @csrf

                            <label><b>Nom de l'activité :</b></label>
                            <input type="text" name="nom" required>

                            <label><b>Description</b></label>
                            <textarea name="description" required></textarea> 

                            <label><b>Image par défaut de cette activité :</b></label>
                            <input type="file"onchange="findsize()" id="monFichier" class="btn btn-primary" name="fichier" required>

                            <div class="right"><button id="bouton-ajouter-image-idee" type="submit" class="btn btn-success"><i class="fas fa-check"></i>Ajouter</button></div>
                        </form>       
                    </div>

                </div>
            </div>
        </div>
</div> 

@endsection