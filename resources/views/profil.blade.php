@extends('layout')

@section('content')


<link rel="stylesheet" href="{{ asset('/css/profil.css') }}">
<?php
$LISTE_CESI = array(
    "Aix-en-Provence",
    "Angoulême",
    "Arras",
    "Bordeaux",
    "Brest",
    "Caen",
    "Dijon",
    "Grenoble",
    "La Rochelle",
    "Le Mans",
    "Lille",
    "Lyon",
    "Montpellier",
    "Nancy",
    "Nantes",
    "Nice",
    "Orléans",
    "Paris Nanterre",
    "Pau",
    "Reims",
    "Rouen",
    "Saint-Nazaire",
    "Strasbourg",
    "Toulouse",);
?>
<div class="container-fluid text-center container">
    
	<h1>Votre profil</h1>
	<h3 class="gauche">Vos informations :</h3>

</div>
    
<div class="container-fluid text-center container">
	<?php

	use App\Inscription;
	use App\Activite;
	$inscription_data = Inscription::orderBy('ID_Utilisateurs')->get();

	$mmm = '';
	$i=0;
	$loc = ucfirst(strtolower(Session::get('localisation')));
	$mdp = Session::get('mdp');
	while (isset($mdp[$i]))
	{
		$mmm = $mmm.substr_replace($mdp[$i], '*', 0);
		$i++;
	}
	
	//Session::put('prenom','oui');


    echo'   <div class="col-lg-12 col-md-12 col-sm-12">
            <div>
            	<div class="infotop">
	                <p class="etage"> Votre prénom : </p>
	                <p class="etage2"> '. Session::get('prenom') .' </p>
	                <div class="center">
				        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-prenom">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	                <p class="etage"> Votre nom : </p>
	                <p class="etage2"> '. Session::get('nom') .' </p>
	                <div class="center">
				        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-nom">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	                <p class="etage"> Votre identifiant : </p>
	                <p class="etage2"> '. Session::get('identifiant') .' </p>
	                <div class="center">
				        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-identifiant">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	                <p class="etage"> Votre mot de passe : </p>
	                <p class="etage2 mdp"> '. $mmm .' </p>
	                <div class="center">
				        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-mdp">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	            	<p class="etage"> Votre adresse email : </p>
	            	<p class="etage2"> '. Session::get('email') .' </p>
	            	<div class="center">
				        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-mail">Modifier</a>
				    </div>
	            </div>
	            <div class="infobot">
	            	<p class="etage"> Votre localisation : </p>
	            	<p class="etage2"> '. $loc .' </p>
	            	<div class="center">
        				<a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-loc">Modifier</a>
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
	<?php




		echo '
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="infotop2">
				<p class="etage"> Activités auxquelles vous vous êtes inscrit : </p>';

				foreach ($inscription_data as $inscription)
				{
					if($inscription['ID_Utilisateurs']=Session::get('id'))
					{
						$actis = Activite::select('Activites.*')
							->join('Inscriptions', 'Activites.ID', '=', 'Inscriptions.ID_Activites')
							->where('Activites.ID',$inscription['ID_Activites'])
							->get();
						foreach ($actis as $acti)
						{

							echo '
							<div class="info2">
								<div class="etage3">
			    				<p class="etageB">'.$acti['Titre'].'</p>
									<div class="center">
				        				<a class="btn btn-default button-activite2 etage4" role="button" data-toggle="modal" data-target="#ajouter-idee">Se désinscrire</a>

				    				</div>
			    				</div>;
		    				</div>';
						}
						

					}
				}

			echo '
			</div>
			<div class="infobot">
				<p class="etage"> Activités que vous avez réalisé : </p>
				<p class="etage2"> Alexandre </p>
			</div>
			</div>';
	?>

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
                        
                        <form class="form-act" action="/profil" method="post" enctype="multipart/form-data">
                            @csrf

                            <label><b>Nom de l\'activité :</b></label>
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

        <div class="modal fade" id="ajouter-prenom" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title" >Changer son prénom</h3>
                    </div>

                    <!-- Panel Ajout activités -->
                    <div class="modal-body basket-content">
                        
                        <form class="form-act" action="/profil" method="post" enctype="multipart/form-data">
                            @csrf

                            <label><b>Nouveau prénom :</b></label>
                            <input type="text" name="nom" required>

                            <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Changer</button></div>
                        </form>       
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="ajouter-nom" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title" >Changer son nom</h3>
                    </div>

                    <!-- Panel Ajout activités -->
                    <div class="modal-body basket-content">
                        
                        <form class="form-act" action="/profil" method="post" enctype="multipart/form-data">
                            @csrf

                            <label><b>Nouveau nom :</b></label>
                            <input type="text" name="nom" required>

                            <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Changer</button></div>
                        </form>       
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="ajouter-identifiant" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title" >Changer son identifiant</h3>
                    </div>

                    <!-- Panel Ajout activités -->
                    <div class="modal-body basket-content">
                        
                        <form class="form-act" action="/profil" method="post" enctype="multipart/form-data">
                            @csrf

                            <label><b>Nouveau identifiant :</b></label>
                            <input type="text" name="nom" required>

                            <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Changer</button></div>
                        </form>       
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="ajouter-mdp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
                    <div class="modal-header">    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title" >Changer son mot de passe</h3>
                    </div>

                    <!-- Panel Ajout activités -->
                    <div class="modal-body basket-content">
                        
                        <form class="form-act" action="/profil" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-6 col-md-6 col-sm-6 etageB">
                            	<div class="etageB"
	                            	<label><b>Ancien mot de passe :</b></label>
	                            </div>
	                            
                        	</div>
                        	<div class="col-lg-6 col-md-6 col-sm-6 etageC">
	                            	<input type="text" name="amdp" required>
	                        </div>

                        	<div class="col-lg-6 col-md-6 col-sm-6 etageB">
                        		<div class="etageB"
	                            	<label><b class="">Nouveau mot de passe :</b></label>
	                            </div>
	                            
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 etageC">
	                            	<input type="text" name="nmdp" required>
	                        </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 etageB">
                            	<div class="etageB"
	                            	<label><b >Confirmation du mot de passe :</b></label>
	                            </div>
	                            
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 etageC">
	                            	<input type="text" name="nmdp2" required>
	                        </div>


                            <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Changer</button></div>
                        </form>       
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="ajouter-mail" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title" >Changer son adresse mail</h3>
                    </div>

                    <!-- Panel Ajout activités -->
                    <div class="modal-body basket-content">
                        
                        <form class="form-act" action="/profil" method="post" enctype="multipart/form-data">
                            @csrf

                            <label><b>Nouvelle adresse mail :</b></label>
                            <input type="text" name="nom" required>

                            <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Changer</button></div>
                        </form>       
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="ajouter-loc" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title" >Changer son centre CESI</h3>
                    </div>

                    <!-- Panel Ajout activités -->
                    <div class="modal-body basket-content">
                        
                        <form class="form-act" action="/profil" method="post" enctype="multipart/form-data">
                        	
                            @csrf
                            
                            <label><b class="espace">Nouveau centre CESI :</b></label>
							<select name="localisation" required>
		                    <option value="0" selected disabled>Votre centre cesi </option>
		                        <?php 
		                        foreach ($LISTE_CESI as $value) {
		                            $min = strtolower($value);
		                           echo '<option value="'. $min .'">'. $value . '</option>';
		                        }
		                        
                        		?>
                    		</select>

                            <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Changer</button></div>
                        </form>       
                    </div>

                </div>
            </div>
        </div>

</div>

@endsection