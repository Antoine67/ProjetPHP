@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/panel_specifique.css') }}">
<link rel="stylesheet" href="{{ asset('/DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<script src="{{ asset('/js/panel_specifique.js') }}"></script>
<script src="{{ asset('/DataTables/datatables.min.js') }}"></script>

<span hidden id="csrf-token"><?=csrf_token() ?></span>
<span hidden id="table-actuelle"><?=$nom_panel ?></span>

<?php



use Illuminate\Support\Facades\DB;

    try {
        $bdd = DB::connection('mysql')->getPdo();
    } catch(Exception $e) {
    
    }
    
    $table=array();
    $nom_colonne=array();
    $reponse = $bdd->prepare('SELECT * FROM '. $nom_panel .' ORDER BY ID ASC');
                                $reponse->execute();
                                while($donnees=$reponse->fetch()){
                                    array_push($table,$donnees);
                                }

  
    foreach($table as $key=>$ligne){
        foreach($ligne as $nom=>$l) {
            if(!is_int($nom))
            array_push($nom_colonne,$nom);
        }break;
    }
   
?>

<hr class="hr-navbar">
<div class="header">
    <nav class="navbar navbar-back-office center">
        <a class="bouton-gestion <?php echo ($_SERVER['REQUEST_URI'] == '/panel/activites' ? 'active' : '');?>" href="/panel/activites" role="button">Activités</a>
        <a class="bouton-gestion <?php echo ($_SERVER['REQUEST_URI'] == '/panel/articles' ? 'active' : '');?>" href="/panel/articles" role="button">Articles</a>
        <a class="bouton-gestion <?php echo ($_SERVER['REQUEST_URI'] == '/panel/avis' ? 'active' : '');?>" href="/panel/avis" role="button">Avis</a>
        <a class="bouton-gestion <?php echo ($_SERVER['REQUEST_URI'] == '/panel/categories' ? 'active' : '');?>" href="/panel/categories" role="button">Categories</a>
        <a class="bouton-gestion <?php echo ($_SERVER['REQUEST_URI'] == '/panel/commandes' ? 'active' : '');?>" href="/panel/commandes" role="button">Commandes</a>
        <a class="bouton-gestion <?php echo ($_SERVER['REQUEST_URI'] == '/panel/commentaire_images' ? 'active' : '');?>" href="/panel/commentaire_images" role="button">Commentaires des images</a>
        <a class="bouton-gestion <?php echo ($_SERVER['REQUEST_URI'] == '/panel/idees' ? 'active' : '');?>" href="/panel/idees" role="button">Idées</a>
        <a class="bouton-gestion <?php echo ($_SERVER['REQUEST_URI'] == '/panel/image_activites' ? 'active' : '');?>" href="/panel/image_activites" role="button">Images des activites</a>
        <a class="bouton-gestion <?php echo ($_SERVER['REQUEST_URI'] == '/panel/inscriptions' ? 'active' : '');?>" href="/panel/inscriptions" role="button">Inscriptions aux activités</a>
        <a class="bouton-gestion <?php echo ($_SERVER['REQUEST_URI'] == '/panel/likes' ? 'active' : '');?>" href="/panel/likes" role="button">Likes des activités</a>
        <a class="bouton-gestion <?php echo ($_SERVER['REQUEST_URI'] == '/panel/paniers' ? 'active' : '');?>" href="/panel/paniers" role="button">Paniers</a>
        <a class="bouton-gestion <?php echo ($_SERVER['REQUEST_URI'] == '/panel/roles' ? 'active' : '');?>" href="/panel/roles" role="button">Roles</a>
        <a class="bouton-gestion <?php echo ($_SERVER['REQUEST_URI'] == '/panel/votes' ? 'active' : '');?>" href="/panel/votes" role="button">Votes des idées</a>
    </nav>
</div>

<div class="container-fluid container"> 
  <h1> Back-office </h1>
  <hr/>
</div>

<div class="container-fluid container"> 

<?php
      
    if(sizeof($table)<=0) {
        echo '
        <div class="col-lg-12 col-md-12 col-sm-12 categories">
            <h2 class = "titre">Gestion des '. ucfirst($nom_panel) .'</h2>
            <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                <div class="center">Aucune donnée trouvée pour la table "'. $nom_panel .'"
                </div>
            </div>
        </div>
        
        ';
    }
    else {

         //URL sur laquelle il faut cherche les images
        //Protocle (HTTP/HTTPS)
        $protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
        $url = $protocol . $_SERVER['SERVER_NAME'];

        //Si il y a port specifique (ex:localhost:8000)
        if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

        $url=$url . '/';






        echo'
        <div class="col-lg-12 col-md-12 col-sm-12 categories">
        <h2 class = "titre">Gestion des '. ucfirst($nom_panel) .'</h2>
        <table id="gestion_tables" class="display" style="width:100%" >
        <thead>
            
            <tr>
            ';
            
            foreach($nom_colonne as $colonne) {
                 echo '<th class="colonnes-tableau">'. $colonne .'</th>';
            }
            echo'<th>Gestion</th>
            </tr>
        </thead>
        <tbody>
        ';
        
            
        foreach($table as $enregistrement) {

            echo ' <tr>';
            $i=0;
            foreach($enregistrement as $el_enregistrement) {
                if($i %2 == 0) {
                    if (preg_match('/\.(png|jpg|gif)/i', $el_enregistrement)) {
                        echo '<td><span class="el-'. $enregistrement["ID"] .'">' .$el_enregistrement. '</span><a href="'.$url.$el_enregistrement.'"> Aperçu</a></td>';  
                    }else {
                         echo '<td><span class="el-'. $enregistrement["ID"] .'">' .$el_enregistrement. '</span></td>';
                    }
                    
                   
                }
                
                $i++;
            }
            echo '
                <td class="bouton-modifier" id="'. $enregistrement["ID"] .'" role="button">Modifier</td>
            </tr>
            ';
        }
        
        echo'   </tbody>
                <tfoot>
                    
                <tr>
                ';
                
                foreach($nom_colonne as $colonne) {
                    echo '<th>'. $colonne .'</th>';
               }
               echo'<th>Gestion</th>
                </tr>
                </tfoot>
            </table>
        </div>
    ';
            }

?>

</div>

@endsection
