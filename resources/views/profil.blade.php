@extends('layout')

@section('content')


<link rel="stylesheet" href="{{ asset('/css/profil.css') }}">

<div class="container-fluid text-center container">
    
	<h1>Votre profil</h1>
	<h3 class="gauche">Vos informations :</h3>

</div>
    
<div class="container-fluid text-center container">
	<?php

	$loc = ucfirst(strtolower(Session::get('localisation')));
	$mdp = Session::get('mdp');



    echo'   <div class="col-lg-12 col-md-12 col-sm-12">
            <div>
            	<div class="infotop">
	                <p class="etage"> Votre prénom : </p>
	                <p class="etage2"> '. Session::get('prenom') .' </p>
	                <div class="center">
				        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-activite">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	                <p class="etage"> Votre nom : </p>
	                <p class="etage2"> '. Session::get('nom') .' </p>
	                <div class="center">
				        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-activite">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	                <p class="etage"> Votre identifiant : </p>
	                <p class="etage2"> '. Session::get('identifiant') .' </p>
	                <div class="center">
				        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-activite">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	                <p class="etage"> Votre mot de passe : </p>
	                <p class="etage2 mdp"> '. $mdp .' </p>
	                <div class="center">
				        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-activite">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	            	<p class="etage"> Votre adresse email : </p>
	            	<p class="etage2"> '. Session::get('email') .' </p>
	            	<div class="center">
				        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-activite">Modifier</a>
				    </div>
	            </div>
	            <div class="infobot">
	            	<p class="etage"> Votre localisation : </p>
	            	<p class="etage2"> '. $loc .' </p>
	            	<div class="center">
        				<a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-activite">Modifier</a>
    				</div>
	            </div>
            </div>
        </div>';
    ?>
</div>

<div class="container-fluid text-center container">
    
	<h3 class="gauche2">Vos activités :</h3>

</div>

<div class="container-fluid text-center container">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="infotop">
			<p class="etage"> Activités auxquelles vous vous êtes inscrit : </p>
			<p class="etage2"> Alexandre </p>
			<div class="center">
        		<a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-activite">se désinscrire</a>
    		</div>
		</div>
		<div class="infobot">
			<p class="etage"> Activités auxquelles vous avez réalisé : </p>
			<p class="etage2"> Alexandre </p>
		</div>
	</div>
</div>

@endsection