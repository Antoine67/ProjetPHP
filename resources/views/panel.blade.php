@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/panel.css') }}">
<link rel="stylesheet" href="{{ asset('/DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<span hidden id="csrf-token"><?=csrf_token() ?></span>
<script src="{{ asset('/js/panel.js') }}"></script>
<script src="{{ asset('/DataTables/datatables.min.js') }}"></script>

<?php

use App\Idee;
use App\Role;

use Illuminate\Support\Facades\DB;

    //URL sur laquelle il faut cherche les images
    //Protocle (HTTP/HTTPS)
    $protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
    $url = $protocol . $_SERVER['SERVER_NAME'];

    //Si il y a port specifique (ex:localhost:8000)
    if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

    $url=$url . '/';


    $idees_proposees = Idee::orderby('Date_creation','ASC')->where('Etat',1)->get();
    $idees_acceptees = Idee::orderby('Date_creation','ASC')->where('Etat',2)->get();
    $idees_refusees = Idee::orderby('Date_creation','ASC')->where('Etat',0)->get();
    $roles_deso = Role::orderby('ID','ASC')->get();
    $roles = array();
    foreach($roles_deso as $r) {
        $roles[$r['ID']] = $r;
    }


try {
    $bdd = DB::connection('mysql2')->getPdo();
} catch(Exception $e) {

}

$utilisateurs=array();
$reponse = $bdd->prepare('SELECT * FROM utilisateurs ORDER BY ID ASC');
                            $reponse->execute();
                            while($donnee=$reponse->fetch()){
                                array_push($utilisateurs,$donnee);
                            }
?>

<div class="container-fluid container"> 
  <h1> Back office </h1>
  <hr/>
</div>

<div class="container-fluid container"> 

<?php



    if(sizeof($idees_proposees)<=0) {
        echo '
        <div class="col-lg-12 col-md-12 col-sm-12 categories">
            <h2 class = "titre">Gestion des utilisateurs</h2>
            <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                <div class="center">Aucune idée proposée
                </div>
            </div>
            <div>
                <label class="left">Vous pensez avoir une bonne idée ?</label>
                <br/>
                <a class="btn btn-default button-activite envoyer" role="button" data-toggle="modal" data-target="#ajouter-idee">Partagez la !</a>
            </div>
        </div>
        
        ';
    }
    else {
        echo'
        <div class="col-lg-12 col-md-12 col-sm-12 categories">
        <h2 class = "titre">Gestion des utilisateurs</h2>
        <table id="example" class="display" style="width:100%" >
        <thead>
            
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Identifiant</th>
                <th>Mot de passe</th>
                <th>Email</th>
                <th>Localisation</th>
                <th>Role</th>
                <th>Droit boutique</th>
                <th>Droit idées</th>
                <th>Droit activités</th>
                <th>Droit header</th>
                <th>Gestion</th>
            </tr>
        </thead>
        <tbody>
        ';
        /*foreach($idees_proposees as $idee_proposee) {
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
                    <a class="btn btn-default upvote-button" role="button" data-toggle="modal" data-target="#upvote-idee"><i class="fas fa-angle-up"> 1000</i></a>
                    <a class="btn btn-default check-button" role="button" data-toggle="modal" data-target="#check-idee"><i class="fas fa-check"></i></a>
                    <a class="btn btn-default ban-button" role="button" data-toggle="modal" data-target="#ban-idee"><i class="fas fa-ban"></i></a>
                </div>
                
            </div>
            <div>
                <label class="left">Vous pensez avoir une bonne idée ?</label>
                <br/>
                <a class="btn btn-default button-activite envoyer" role="button" data-toggle="modal" data-target="#ajouter-idee">Partagez la !</a>
            </div>
            
            ';
        }
        
                                
                        */

        foreach($utilisateurs as $utilisateur) {
            $utilisateur['DroitBoutique'] = $roles[$utilisateur['Role']]['Perm_boutique'];
            $utilisateur['DroitIdees'] = $roles[$utilisateur['Role']]['Perm_idees'];
            $utilisateur['DroitActivites'] = $roles[$utilisateur['Role']]['Perm_activites'];
            $utilisateur['DroitHeader'] = $roles[$utilisateur['Role']]['Perm_header'];
            
            echo '
            

                
                    <tr>
                        <td><span class="el-'. $utilisateur["ID"] .'">'. $utilisateur["Nom"] .'</span></td>
                        <td><span class="el-'. $utilisateur["ID"] .'">'. $utilisateur['Prenom'] .'</span></td>
                        <td><span class="el-'. $utilisateur["ID"] .'">'. $utilisateur['Identifiant'] .'</span></td>
                        <td><span class="el-'. $utilisateur["ID"] .'">'. $utilisateur['Mot_de_passe'] .'</span></td>
                        <td><span class="el-'. $utilisateur["ID"] .'">'. $utilisateur['Email'] .'</span></td>
                        <td><span class="el-'. $utilisateur["ID"] .'">'. $utilisateur['Localisation'] .'</span></td>
                        <td><span class="el-'. $utilisateur["ID"] .'">'. $utilisateur['Role'] .'</span></td>
                        <td><span class="el-'. $utilisateur["ID"] .'">'. $utilisateur['DroitBoutique'] .'</span></td>
                        <td><span class="el-'. $utilisateur["ID"] .'">'. $utilisateur['DroitIdees'] .'</span></td>
                        <td><span class="el-'. $utilisateur["ID"] .'">'. $utilisateur['DroitActivites'] .'</span></td>
                        <td><span class="el-'. $utilisateur["ID"] .'">'. $utilisateur['DroitHeader'] .'</span></td>
                        <td class="bouton-modifier" id="'. $utilisateur["ID"] .'" role="button">Modifier</td>

                    </tr>
                ';
        }
        echo'   </tbody>
                <tfoot>
                    
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Identifiant</th>
                        <th>Mot de passe</th>
                        <th>Email</th>
                        <th>Localisation</th>
                        <th>Role</th>
                        <th>Droit boutique</th>
                        <th>Droit idées</th>
                        <th>Droit activités</th>
                        <th>Droit header</th>
                        <th>Gestion</th>
                    </tr>
                </tfoot>
            </table>
        </div>';
    }
  
        
    if(sizeof($idees_acceptees)<=0) {
        echo '
            <div class="col-lg-12 col-md-12 col-sm-12 categories">
                <h2 class = "titre">Idées acceptées</h2>
                <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                    <div class="center">Aucune idée n\'a été acceptée
                    </div>
                </div>
            </div>
            ';
        }
    else {
        
        foreach($idees_acceptees as $idee_acceptee) {
            echo '
                <div class="col-lg-12 col-md-12 col-sm-12 categories">
                <h2 class = "titre">Idées acceptées</h2>
                <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                    <div class="left"> 
                        '. $idee_acceptee['Titre'] .' 
                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                        <img class="img" src=' . $url . $idee_acceptee['Image'] .' alt ="Image idée">
                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-10 idee">
                        '.$idee_acceptee['Contenu'].'
                    </div>
                </div>
            </div>
                
            ';
        }
    }

        if(sizeof($idees_refusees)<=0) {
            echo '
            <div class="col-lg-12 col-md-12 col-sm-12 categories">
                <h2 class = "titre">Idées refusées</h2>
                <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                    <div class="center">Aucune idée n\'a été refusée
                    </div>
                </div>
            </div>
        </div>
            ';
        }
        else {
            foreach($idees_refusees as $idee_refusee) {
                echo '
                <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                    <div class="left titre-activite"> 
                        '. $idee_refusee['Titre'] .' 
                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                        '. $idee_refusee['Image'] .'
                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-10 idee">
                        '.$idee_refusee['Contenu'].'
                    </div>
                </div>
            </div>
                ';
            }

            } 
?>
    <!--Ajout activités -->
    <div class="modal fade" id="modifier-utilisateur" tabindex="-1" role="dialog" aria-hidden="true">
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

                            <label><b>Description :</b></label>
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