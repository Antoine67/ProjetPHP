@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/idees.css') }}">
<span hidden id="csrf-token"><?=csrf_token() ?></span>
<script src="{{ asset('/js/idee.js') }}"></script>

<?php

use App\Idee;
use App\Vote;

use Illuminate\Support\Facades\DB;

?>



<div class="container-fluid container"> 
  <h1> La boîte à idées </h1>
  <hr/>
</div>

<div class="container-fluid container"> 

<?php
    //URL sur laquelle il faut cherche les images
    //Protocle (HTTP/HTTPS)
    $protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
    $url = $protocol . $_SERVER['SERVER_NAME'];

    //Si il y a port specifique (ex:localhost:8000)
    if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

    $url=$url . '/';

?>




    









<?php

/*
Idee::select('Idees.*','Votes.Quantité')
->join('Votes', 'Votes.ID_Idees', '=', 'Idees.ID')
->where('ID_Utilisateurs',Session::get('id'))
->get();*/




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
                <label class="left">Vous avez une idée d\'activité à soumettre ? ?</label>
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

                <div class="col-lg-2 col-md-2 col-sm-2 upvote">
                    <a class="btn btn-default upvote-button icone '. $classe_bouton_like .'" role="button" id="vote-'.$idee_proposee['ID'].'">
                        <i class="fas fa-angle-up"> '.$nb_votes.'</i>
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

                <div class="col-lg-2 col-md-2 col-sm-2 upvote">
                    <a class="btn btn-default upvote-button icone '. $classe_bouton_like .'" role="button" id="vote-'.$idee_acceptee['ID'].'">
                        <i class="fas fa-angle-up"> '.$nb_votes.'</i>
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

?>
    <!--

    <div class="col-lg-12 col-md-12 col-sm-12 categories">
        <h2 class = "titre">Idées proposées</h2>
        

            <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
        
            <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                <img class="img" src="{{ asset('/img/1.jpeg') }}" >
            </div>

            <div class="col-lg-10 col-md-10 col-sm-10 idee">
                <p class="left">- Vos collègues, votre famille, vos amis... Le nouveau Ranger vous offre l'espace qu'il vous faut parmi trois styles de cabines et quatre modèles. 
                Toujours aussi spacieux et mieux équipé que jamais, vous et vos passagers profiterez d'un véritable espace de confort et d'élégance. 
                </p>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 upvote">
                <a class="btn btn-default upvote-button" role="button" data-toggle="modal" data-target="#upvote-idee"><i class="fas fa-angle-up"> 1000</i> </a>
                <a class="btn btn-default check-button" role="button" data-toggle="modal" data-target="#check-idee"><i class="fas fa-check"></i></a>
                <a class="btn btn-default ban-button" role="button" data-toggle="modal" data-target="#ban-idee"><i class="fas fa-ban"></i></a>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
            <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                <img class="img" src="{{ asset('/img/1.jpeg') }}" >
            </div>

            <div class="col-lg-10 col-md-10 col-sm-10 idee">
                <p class="left">- Vos collègues, votre famille, vos amis... Le nouveau Ranger vous offre l'espace qu'il vous faut parmi trois styles de cabines et quatre modèles. 
                Toujours aussi spacieux et mieux équipé que jamais, vous et vos passagers profiterez d'un véritable espace de confort et d'élégance. 
                </p>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 upvote">
                <a class="btn btn-default upvote-button" role="button" data-toggle="modal" data-target="#upvote-idee"><i class="fas fa-angle-up"> 1000</i></a>
                <a class="btn btn-default check-button" role="button" data-toggle="modal" data-target="#check-idee"><i class="fas fa-check"></i></a>
                <a class="btn btn-default ban-button" role="button" data-toggle="modal" data-target="#ban-idee"><i class="fas fa-ban"></i></a>
            </div>
        </div>
    </div>
        <div>
            <label class="left">Vous avez une idée d'activité à soumettre ?</label>
            <br/>
            <a class="btn btn-default button-activite envoyer" role="button" data-toggle="modal" data-target="#ajouter-idee">Partagez la !</a>
        </div>
    <div>

        
        -->

    <?php } ?>
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
                            <input type="file" class="btn btn-primary" name="fichier" required>

                            <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Ajouter</button></div>
                        </form>       
                    </div>

                </div>
            </div>
        </div>
</div> 

@endsection