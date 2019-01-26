@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/panel.css') }}">
<link rel="stylesheet" href="{{ asset('/DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<span hidden id="csrf-token"><?=csrf_token() ?></span>
<script src="{{ asset('/js/panel.js') }}"></script>
<script src="{{ asset('/DataTables/datatables.min.js') }}"></script>


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


<div class="container-fluid container"> 
  <h1> Back-office </h1>
  <hr/>
</div>

<div class="container-fluid container"> 

<?php
      
    if(sizeof($table)<=0) {
        echo '
        <div class="col-lg-12 col-md-12 col-sm-12 categories">
            <h2 class = "titre">Gestion des '. $nom_panel .'</h2>
            <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
                <div class="center">Aucune donnée trouvée pour la table "'. $nom_panel .'"
                </div>
            </div>
        </div>
        
        ';
    }
    else {
        echo'
        <div class="col-lg-12 col-md-12 col-sm-12 categories">
        <h2 class = "titre">Gestion des '. $nom_panel .'</h2>
        <table id="example" class="display" style="width:100%" >
        <thead>
            
            <tr>
            ';
            
            foreach($nom_colonne as $colonne) {
                 echo '<th>'. $colonne .'</th>';
            }
            echo'<th>Gestion</th>
            </tr>
        </thead>
        <tbody>
        ';
        
            
        foreach($table as $enregistrement) {

            echo '
            <tr>
            ';
            $i=0;
            foreach($enregistrement as $el_enregistrement) {
                if($i %2 == 0) 
                echo '<td><span class="el-'. $enregistrement["ID"] .'">' .$el_enregistrement. '</span></td>';
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
    </div>';
            }

?>
 

@endsection
