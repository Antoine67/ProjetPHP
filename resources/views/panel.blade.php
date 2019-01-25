@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/panel.css') }}">
<link rel="stylesheet" href="{{ asset('/DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<span hidden id="csrf-token"><?=csrf_token() ?></span>
<script src="{{ asset('/js/panel.js') }}"></script>
<script src="{{ asset('/DataTables/datatables.min.js') }}"></script>
<hr class="hr-navbar">
<div class="header">
    <nav class="navbar navbar-back-office center">
        <a class="btn btn-default bouton-gestion" href="/panel/activites" role="button">Activités</a>
        <a class="btn btn-default bouton-gestion" href="/panel/articles" role="button">Articles</a>
        <a class="btn btn-default bouton-gestion" href="/panel/avis" role="button">Avis</a>
        <a class="btn btn-default bouton-gestion" href="/panel/categories" role="button">Categories</a>
        <a class="btn btn-default bouton-gestion" href="/panel/commandes" role="button">Commandes</a>
        <a class="btn btn-default bouton-gestion" href="/panel/commentaire_images" role="button">Commentaires des images</a>
        <a class="btn btn-default bouton-gestion" href="/panel/idees" role="button">Idées</a>
        <a class="btn btn-default bouton-gestion" href="/panel/image_activites" role="button">Images des activites</a>
        <a class="btn btn-default bouton-gestion" href="/panel/inscriptions" role="button">Inscriptions aux activités</a>
        <a class="btn btn-default bouton-gestion" href="/panel/likes" role="button">Likes des activités</a>
        <a class="btn btn-default bouton-gestion" href="/panel/paniers" role="button">Paniers</a>
        <a class="btn btn-default bouton-gestion" href="/panel/roles" role="button">Roles</a>
        <a class="btn btn-default bouton-gestion" href="/panel/votes" role="button">Votes des idées</a>
    </nav>
</div>

<?php

use App\Idee;
use App\Role;
use App\Commande;

use Illuminate\Support\Facades\DB;

    //URL sur laquelle il faut cherche les images
    //Protocle (HTTP/HTTPS)
    $protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
    $url = $protocol . $_SERVER['SERVER_NAME'];

    //Si il y a port specifique (ex:localhost:8000)
    if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

    $url=$url . '/';

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



    if(sizeof($roles)<=0) {
        echo '
        <div class="col-lg-12 col-md-12 col-sm-12 categories">
            <h2 class = "titre">Gestion des utilisateurs</h2>
            <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                <div class="center">Aucun utilisateur a été trouvé
                </div>
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
                <th>ID</th>
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

        foreach($utilisateurs as $utilisateur) {
            $utilisateur['DroitBoutique'] = $roles[$utilisateur['Role']]['Perm_boutique'];
            $utilisateur['DroitIdees'] = $roles[$utilisateur['Role']]['Perm_idees'];
            $utilisateur['DroitActivites'] = $roles[$utilisateur['Role']]['Perm_activites'];
            $utilisateur['DroitHeader'] = $roles[$utilisateur['Role']]['Perm_header'];
            
            echo '
            

                
                    <tr>
                        <td>'. $utilisateur["ID"] .'</td>
                        <td class="nom"><span class="el-'. $utilisateur["ID"] .'">'. $utilisateur["Nom"] .'</span></td>
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
                        <th>ID</th>
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

?>

</div> 

@endsection