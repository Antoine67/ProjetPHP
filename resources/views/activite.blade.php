@extends('layout')

@section('content')

<?php 
use App\Activite; 
use App\ImageActivite;


?>
<link rel="stylesheet" href="{{ asset('/css/activite.css') }}">

    <div class="center">
        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#ajouter-activite">Ajouter une activité</a>
        <a class="btn btn-default button-activite" role="button" data-toggle="modal" data-target="#supprimer-activite">Supprimer une activité</a>
    </div>
    <!--Ajout activités) -->
    <div class="modal fade" id="ajouter-activite" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

                    <h3 class="modal-title" >Ajouter une activité</h3>

                </div>

                <!-- Panel Ajout activités -->
                <div class="modal-body basket-content">
                    
                    <form action="/activites" method="post" enctype="multipart/form-data">
                        @csrf

                        <label><b>Nom de l'activité :</b></label>
                        <input type="text" name="nom" required>
                    

                        <label><b>Description</b></label>
                        <textarea name="description" required></textarea>


                        <label><b>Prix</b></label>
                        <input type="text" name="prix" required>
              
                        <label><b>Date</b> </label>
                        <input type="text" id="datepicker" name="date" required>
 

                        <label><b>Image par défaut de cette activité :</b></label>
                        <input type="file" class="btn btn-primary" name="fichier" required>



                        <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Ajouter</button></div>
                    </form>       
                </div>

             </div>
         </div>
    </div>

    <!--  Suppression activités -->
    <div class="modal fade" id="supprimer-activite" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

                    <h3 class="modal-title">Supprimer une activité</h3>
                   <h4>Attention toute suppression est irrémediable</h4>

                </div>

                <!-- Panel Suppresion activités -->
                <div class="modal-body basket-content">
                
                <?php 
                    $activites_all = Activite::orderBy('Titre','ASC')->get();
                    echo '<div>';
                    foreach ($activites_all as $activite) {
                        echo '<div class="suppression">';
                        echo '<form method="post" action="/activites"><button type="submit" class="btn btn-danger">Supprimer</button>';
                        ?>@csrf<?php //Token csrf
                        echo '<p class="titre-suppression" name="titre-activite" readonly>'. $activite['Titre'] .'</p>' ;
                        echo '<input type="hidden" name="id-activite" readonly value="'.$activite['ID']. '"></input>';
                        
                        echo '</form></div>';
                    }
                    echo '</div>';
                    
                    ?>
                </div>

             </div>
         </div>
    </div>


<?php 







$activites = Activite::orderBy('Date_realisation','ASC')->get();
if(sizeof($activites) == 0) {
    echo '<div class="center">Aucune activité trouvée</div>';
}else {
    //URL sur laquelle il faut cherche les images
    //Protocle (HTTP/HTTPS)
    $protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
    $url = $protocol . $_SERVER['SERVER_NAME'];

    //Si il y a port specifique (ex:localhost:8000)
    if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }
    $url=$url . '/';
    
    
    $dateActuelle = new DateTime();
    $dateActuelle = $dateActuelle->format('Y-m-d');

    $activitees_passees = array();
    $activitees_futures = array();
    $activitees_aujourd = array();
    
    foreach ($activites as $activite) {//Chaque activité trouvée

        $img = ImageActivite::where('ID_Activites', $activite['ID'])->take(1)->get();
        if(sizeof($img)!=0) {
            $activite['Image'] = '<img class="image-activite" src="'.$img[0]['Image'].'"  alt="Image">' ;
        }else {
            $activite['Image'] = '<div class="no-image">Aucune image n\'est encore associée à cette activité</div>';
        }
       
        $date = new DateTime($activite['Date_realisation']);
        $date = $date->format('Y-m-d');

        if($date == $dateActuelle) {
            array_push($activitees_aujourd, $activite);
        }else if($date < $dateActuelle) {
            array_push($activitees_passees, $activite);
        }else {
            array_push($activitees_futures, $activite);
        }
    }

    if(sizeof($activitees_aujourd) != 0) {
        $activiteSuivante = $activitees_aujourd[0]; 
    } else if (sizeof($activitees_futures) != 0) {
        $activiteSuivante = $activitees_futures[0]; 
    }

    echo '<div class="container text-center">';

    if(isset($activiteSuivante)) {
        $img = ImageActivite::where('ID_Activites', $activiteSuivante['ID'])->take(1)->get();
        if(sizeof($img)!=0) {
            $imgProchaineActivite = '<img class="vitrine" src="'. $url . $img[0]['Image'].'" alt="Image" >';
        }else {
            $imgProchaineActivite = 'Aucune image n\'est encore associée à cette activité';
        }

        echo'
            <div class="row">
                <h1> Prochaine activité </h1>
                <hr class="hr2">
                <a href="/activites/'.$activiteSuivante['ID'].'">
                    <div>
                        <div class="prochaine-activite">
                            <h2><br>'.$activiteSuivante['Titre'].'</h2>          
                        </div>
                        <div>
                        '. $imgProchaineActivite .'     
                        </div>  
                    </div>
                </a>
            </div>
        ';
    }else {

    }
    
    
   
?>







    <?php 

    $activitees_categories = array(
        "ajd"  => array('Titre' => 'Activités du jour','Tableau' => $activitees_aujourd),
        "venir" => array('Titre' => 'Activités à venir','Tableau' => $activitees_futures),
        "pasees"   => array('Titre' => 'Activités passées','Tableau' => $activitees_passees),
    );

    foreach ($activitees_categories as $categorie) {
        $acts = $categorie['Tableau'];
        echo '
        <div class="row">
            <h1> '. $categorie['Titre'] .' </h1>
            <hr class="hr2">'; 

        if(sizeof($acts) == 0) {
            echo 'Aucune activité';
        }else {
            foreach ($acts as $activite) {
                echo '
                <a href="/activites/'.$activite['ID'].'" >
                    <div class="col-lg-4 col-md-5 col-sm-6">
                       
                        <div class="divv">
                            <h2><br>'.$activite['Titre'].'</h2>
                                '.$activite['Image'].' 
                            <p class="description">'.$activite['Description'].'</p>  
                        </div>
                        
                        
                      
                        
                    </div>
                </a>';
            }
        }
       
    echo '</div>'; 
    }?>

</div>

<?php } ?>



<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker( $.datepicker.regional[ "fr" ] );
    $( "#anim" ).on( "change", function() {
      $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
    });

    $( ".suppression button" ).click(
        function () {
            if (confirm('Êtes vous sûr de vouloir supprimer cette activité ?')) {
                // Si oui
                return true;
            } else {
                // Si non
                return false;
            }
               
            });



  } );




  
  </script>

@endsection