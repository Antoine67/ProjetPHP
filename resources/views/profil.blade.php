@extends('layout')

@section('content')


<link rel="stylesheet" href="{{ asset('/css/profil.css') }}">
<script src="{{ asset('/js/profil.js') }}"></script>
<script src="{{ asset('/js/verifFormProfil.js') }}"></script>

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
	echo Session::get('token');

    echo'   <div class="col-lg-12 col-md-12 col-sm-12">


    		<span hidden id="idtexte">'.Session::get('id').'<?=$nom_table?></span>

            <div>
            	<div class="infotop">
	                <p class="etage"> Votre prénom : </p>
	                <p id="prenomtexte" class="etage2"> '. Session::get('prenom') .' </p>
	                <div class="center">
				        <a id="prenom" class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-prenom">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	                <p class="etage"> Votre nom : </p>
	                <p id="nomtexte" class="etage2"> '. Session::get('nom') .' </p>
	                <div class="center">
				        <a id="nom" class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-nom">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	                <p class="etage"> Votre identifiant : </p>
	                <p id="identifianttexte" class="etage2"> '. Session::get('identifiant') .' </p>
	                <div class="center">
				        <a id="identifiant" class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-identifiant">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	                <p class="etage"> Votre mot de passe : </p>
	                <p id="mdptexte" class="etage2 mdp"> '. $mmm .' </p>
	                <div class="center">
				        <a id="mdp" class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-mdp">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	            	<p class="etage"> Votre adresse email : </p>
	            	<p id="emailtexte" class="etage2"> '. Session::get('email') .' </p>
	            	<div class="center">
				        <a id="email" class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-mail">Modifier</a>
				    </div>
	            </div>
	            <div class="infobot">
	            	<p class="etage"> Votre localisation : </p>
	            	<p id="localisationtexte" class="etage2"> '. $loc .' </p>
	            	<div class="center">
        				<a id="localisation" class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-loc">Modifier</a>
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
					if($inscription['ID_Utilisateurs']==Session::get('id'))
					{
						$actis = Activite::select('Activites.*')
							->join('Inscriptions', 'Activites.ID', '=', 'Inscriptions.ID_Activites')
							->where('Activites.ID',$inscription['ID_Activites'])
							->get();
						foreach ($actis as $acti)
						{
							if($inscription['Date_incription']>$acti['Date_realisation'])
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
					
					if($inscription['Date_incription']<$acti['Date_realisation'])	
					{
						echo '
						<div class="info2">
							<div class="etage3">
				    		<p class="etageB">Vous n\'êtes inscrit à aucune activité.</p>
										
				    		</div>.
			    		</div>';
			    		break; 		
			    	}
			    	
				}
			}

			if(!isset($inscription))
				{
					
						echo '
						<div class="info2">
							<div class="etage3">
				    		<p class="etageB">Vous n\'êtes inscrit à aucune activité.</p>
										
				    		</div>
			    		</div>';	
			    	
				}



			echo '
			</div>
			<div class="infobot2">
				<p class="etage"> Activités que vous avez réalisé : </p>';
				foreach ($inscription_data as $inscription)
				{
					if($inscription['ID_Utilisateurs']==Session::get('id'))
					{
						$actis = Activite::select('Activites.*')
							->join('Inscriptions', 'Activites.ID', '=', 'Inscriptions.ID_Activites')
							->where('Activites.ID',$inscription['ID_Activites'])
							->get();
						foreach ($actis as $acti)
						{
							if($inscription['ID_Utilisateurs']==Session::get('id'))
							{
								if($inscription['Date_incription']<$acti['Date_realisation'])
								{

								echo '
								<div class="info2">
									<div class="etage3">
				    				<p class="etageB">'.$acti['Titre'].' le '.$acti['Date_realisation'].'</p>
				    				</div>.
			    				</div>';

								}
							}

						}

						if($inscription['Date_incription']>$acti['Date_realisation'])	
						{
							echo '
							<div class="info2">
								<div class="etage3">
					    		<p class="etageB">Vous n\'êtes inscrit à aucune activité.</p>
											
					    		</div>;
				    		</div>';
				    		break; 		
				    	}
						

					}
				}

				if(!isset($inscription))
				{
					
						echo '
						<div class="info2">
							<div class="etage3">
				    		<p class="etageB">Vous vous n\'êtes inscrit à aucune activité.</p>
										
				    		</div>;
			    		</div>';	
			    	
				}

				echo'
			</div>
			</div>';
	?>

	    <div class="modal fade" id="ajouter-idee" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title" >Confirmation</h3>
                    </div>

                    <!-- Panel Ajout activités -->
                    <div class="modal-body basket-content">

                            <div class="col-lg-6 col-md-6 col-sm-6 etageB right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Oui</button></div>
                            <div class="col-lg-6 col-md-6 col-sm-6 etageC right"><button data-dismiss="modal" class="btn btn-danger"><i class="fas fa-times"></i>Non</button></div>  
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

                            <label><b>Nouveau prénom :</b></label>
                            <input id="newprenom" type="text" name="nom" required>

                            <div class="right"><button id="modifierprenom" type="button" data-dismiss="modal" class="btn btn-success"><i class="fas fa-check"></i>Changer</button></div>
                             
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

                            <label><b>Nouveau nom :</b></label>
                            <input type="text" name="nom" required>

                            <div class="right"><button id="modifiernom" type="button" data-dismiss="modal" class="btn btn-success"><i class="fas fa-check"></i>Changer</button></div>
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

                            <label><b>Nouveau identifiant :</b></label>
                            <input type="text" name="nom" required>

                            <div class="right"><button id="modifieridentifiant" type="button" data-dismiss="modal" class="btn btn-success"><i class="fas fa-check"></i>Changer</button></div>
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


                        	<div class="col-lg-6 col-md-6 col-sm-6 etageB">
                        		<div class="etageB">
	                            	<label><b class="">Nouveau mot de passe :</b></label>
	                            </div>
	                        </div>
	                            
                            <div>
                            	<div class="col-lg-6 col-md-6 col-sm-6 etageC">
	                            	<input id="mdpp" type="text" name="nmdp" onblur="verifMdp(this)" required>
	                        	</div>
	                        </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 etageB">
                            	<div class="etageB">
	                            	<label><b >Confirmation du mot de passe :</b></label>
	                            </div>
	                            
                            </div>
                        	<div class="col-lg-6 col-md-6 col-sm-6 etageC">
                            	<input id="mdpconf" type="text" name="nmdp2" onblur="verifConfMdp(this)" required>
                        	</div>



                            <div class="right"><button id="modifiermdp" type="button2" data-dismiss="modal" class="btn btn-success butbut"><i class="fas fa-check"></i>Changer</button></div>
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

                            <label><b>Nouvelle adresse mail :</b></label>
                            <input id="mdpconf" type="text" name="nom" onblur="verifMail(this)" required>

                            <div class="right"><button id="modifieremail" type="button" data-dismiss="modal" class="btn btn-success butbut"><i class="fas fa-check"></i>Changer</button></div>
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

                            <div class="right"><button id="modifierlocalisation" type="button" data-dismiss="modal" class="btn btn-success"><i class="fas fa-check"></i>Changer</button></div>   
                    </div>

                </div>
            </div>
        </div>

</div>

@endsection