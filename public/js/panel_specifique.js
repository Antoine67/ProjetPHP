$(document).ready(function() {

    $('#gestion_tables').DataTable( 
        {"language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', { extend: 'print', text: 'Imprimer' },
            
        ]
    } );

    bindModifier();
    bindConfirmer();
} );


function bindModifier(element) {
    if(element == null) {
        element =  $('.bouton-modifier');
    }
    element.click(function() {
        el_clq = $(this);
        id_btn = $(this).attr('id');
        let incr =0; //Nb de champs modifiables
        $('.el-'+id_btn).each(function() {
            if(incr<7) {
                $( this ).replaceWith('<input class="inp-'+id_btn+'"value="'+$(this).text()+'">');
            }incr++;
            
          });

          el_clq.replaceWith('<td id="'+id_btn+'" class="bouton-confirmer" role="button">Confirmer</td>');
          bindConfirmer($('#'+id_btn));
      });


   
}


function bindConfirmer(element) {
    if(element == null) {
        element = $('.bouton-confirmer');
    }
    element.click(function() {
 
        el_clq = $(this);
        id_btn = $(this).attr('id');


        var colonnes_tableaux = Array();


        $('.colonnes-tableau').each(function() {
            colonnes_tableaux.push( $(this).text() );
        });


        var donnee = new Object();

        var incr=0;
        //On remplace les inputs par de simples textes et on remplit le tableau "donnee" de chaque colonne présente
        $('.inp-'+id_btn).each(function() {
            let el_text = $(this).val();
           
            $( this ).replaceWith('<textarea readonly class="el-'+id_btn+'">'+el_text+'</textarea>');

            donnee[colonnes_tableaux[incr]] = $( this ).val() ;


            incr++;
          });

         /* Affichage des données si nécessaires
          console.log('COLS:');
          for (var i = 0; i < colonnes_tableaux.length; i++) {
            console.log(colonnes_tableaux[i] + ' : '+donnee[colonnes_tableaux[i]]);
          }*/

          el_clq.replaceWith('<td id="'+id_btn+'" class="bouton-modifier" role="button">Modifier</td>');

          bindModifier($('#'+id_btn));
          

                    
          var currentToken = $('#csrf-token').text();
          var table_actuelle = $('#table-actuelle').text();



          var stringDonnee = JSON.stringify( donnee );


            $.ajax({
                url: '/gerer-donnees',
                type: 'post',
                data: {
                    'action':'modif-table',
                    'table': table_actuelle,
                    'donnee': stringDonnee,
                    '_token' : currentToken //Utilisé pour la verification csrf
                },


                success: function(response){
                    console.log(response);
                },
                error: function(xhr, textStatus, errorThrown) { 
                    console.log(errorThrown);
                    console.log(xhr.responseText);
                }    
            });




      });
      
}



