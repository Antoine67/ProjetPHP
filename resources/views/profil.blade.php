@extends('layout')

@section('content')


<link rel="stylesheet" href="{{ asset('/css/profil.css') }}">
<script src="{{ asset('/js/verifFormProfil.js') }}"></script>
<script src="{{ asset('/js/profil.js') }}"></script>


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
	
	$id = Session::get('id');



	$url= 'http://localhost:3000/api/utilisateurs/'.$id;


	$ch = curl_init();

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: token_cookie_bde=".Session::get('token')));

	$result=curl_exec($ch);

	curl_close($ch);

	$utilisateur=json_decode($result, true)[0];
	$loc = $utilisateur["Localisation"];
	$mdp = $utilisateur["Mot_de_passe"];

	while (isset($mdp[$i]))
	{
		$mmm = $mmm.substr_replace($mdp[$i], '*', 0);
		$i++;
	}

    echo'   <div class="col-lg-12 col-md-12 col-sm-12">

    		<span hidden id="tokentexte">'.Session::get('token').'</span>
    		<span hidden id="idtexte">'.Session::get('id').'</span>
    		<span hidden id="roletexte">'.Session::get('role').'</span>

            <div>
            	<div class="infotop">
	                <p class="etage"> Votre prénom : </p>
	                <p id="prenomtexte" class="etage2">'. $utilisateur["Prenom"] .'</p>
	                <div class="center">
				        <a id="prenom" class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-prenom">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	                <p class="etage"> Votre nom : </p>
	                <p id="nomtexte" class="etage2">'. $utilisateur["Nom"] .'</p>
	                <div class="center">
				        <a id="nom" class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-nom">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	                <p class="etage"> Votre identifiant : </p>
	                <p id="identifianttexte" class="etage2">'.$utilisateur["Identifiant"].'</p>
	                <div class="center">
				        <a id="identifiant" class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-identifiant">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	                <p class="etage"> Votre mot de passe : </p>
	                <p id="mdptexte" class="etage2 mdp">'. $mmm .'</p>
	                <div class="center">
				        <a id="mdp" class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-mdp">Modifier</a>
				    </div>
	            </div>
	            <div class="info">
	            	<p class="etage"> Votre adresse email : </p>
	            	<p id="emailtexte" class="etage2">'. $utilisateur["Email"] .'</p>
	            	<div class="center">
				        <a id="email" class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-mail">Modifier</a>
				    </div>
	            </div>
	            <div class="infobot">
	            	<p class="etage"> Votre localisation : </p>
	            	<p id="localisationtexte" class="etage2">'. $loc .'</p>
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

		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="infotop2">
					<p class="etage"> Activités auxquelles vous vous êtes inscrit : </p>
				
					<?php
					$compt = 0;
				foreach ($inscription_data as $inscription)
					{
						$actis = Activite::select('Activites.*')
							->where('Activites.ID',$inscription['ID_Activites'])
							->get();
						foreach ($actis as $acti)
						{
							if($inscription['Date_inscription']<=$acti['Date_realisation'])
							{
								if($inscription['ID_Utilisateurs']==$id)
							{
								$compt = 1;

							echo '
							<div class="info2">
								<div class="etage3">
			    				<p class="etageB">'.$acti['Titre'].'</p>
			    				</div> 
		    				</div>';
		    				}
		    			}
		    				
						
					
					if(($inscription['Date_inscription']>$acti['Date_realisation'])&&($compt!=1))	
					{
						$compt = 1;
						echo '
						<div class="info2">
							<div class="etage3">
				    		<p class="etageB">Vous n\'êtes inscrit à aucune activité.</p>
										
				    		</div> 
			    		</div>';
			    		break; 		
			    	}
			    	}
			    	}
				
			

			if($compt == 0)
				{
					
						echo '
						<div class="info2">
							<div class="etage3">
				    		<p class="etageB">Vous n\'êtes inscrit à aucune activité.</p>
										
				    		</div> 
			    		</div>';
			    	
				}
				?>


			</div>
			<div class="infobot2">
				<p class="etage"> Activités que vous avez réalisé : </p>

				<?php
				$compt = 0;
				foreach ($inscription_data as $inscription)
				{
					if($inscription['ID_Utilisateurs']==Session::get('id'))
					{
						$actis = Activite::select('Activites.*')
							->where('Activites.ID',$inscription['ID_Activites'])
							->get();
						foreach ($actis as $acti)
						{
							if($inscription['ID_Utilisateurs']==Session::get('id'))
							{
								if(strtotime($inscription['Date_inscription'])>strtotime($acti['Date_realisation']))
								{
									$compt = 1;

								echo '
								<div class="info2">
									<div class="etage3">
				    				<p class="etageB">'.$acti['Titre'].' le '.$acti['Date_realisation'].'</p>
				    				</div> 
			    				</div>';

								}
							}

						}

						if(($inscription['Date_inscription']<$acti['Date_realisation'])&&($compt!=1))	
						{
							$compt = 1;
							echo '
							<div class="info2">
								<div class="etage3">
					    		<p class="etageB">Vous n\'avez participé à aucune activité.</p>
											
					    		</div> 
				    		</div>';
				    		break; 		
				    	}
						

					}
				}

				if($compt == 0)
				{
					
						echo '
						<div class="info2">
							<div class="etage3">
				    		<p class="etageB">Vous n\'avez participé à aucune activité.</p>
										
				    		</div> 
			    		</div>';	
			    	
				}

				?>
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
                            <input id="newnom" type="text" name="nom" required>

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
                            <input id="newidentifiant" type="text" name="nom" required>

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
	                            	<input id="mdpp" type="password" name="nmdp" required>
	                        	</div>
	                        </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 etageB">
                            	<div class="etageB">
	                            	<label><b >Confirmation du mot de passe :</b></label>
	                            </div>
	                            
                            </div>
                        	<div class="col-lg-6 col-md-6 col-sm-6 etageC">
                            	<input id="newmdp" type="password" name="nmdp2" required>
                        	</div>



                            <div class="right"><button id="modifiermdp" type="button" data-dismiss="modal" class="btn btn-success butbut"><i class="fas fa-check"></i>Changer</button></div>
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
                            <input id="newemail" type="text" name="nom" required>

                            <div class="right"><button id="modifieremail" type="submit" data-dismiss="modal" class="btn btn-success butbut"><i class="fas fa-check"></i>Changer</button></div>
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
							<select id="newlocalisation" name="localisation" required>
		                    <option value ="" selected disabled>Votre centre cesi </option>
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