$(document).ready(function() {

    $('#example').DataTable( 
        {"language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', { extend: 'print', text: 'Imprimmer' },
            
        ]
    } );

    bindModifier();
    bindConfirmer();
} );


function bindModifier() {
    $('.bouton-modifier').click(function() {
        el_clq = $(this);
        id_btn = $(this).attr('id');

        $('.el-'+id_btn).each(function() {
            $( this ).replaceWith('<input class="inp-'+id_btn+'"value="'+$(this).text()+'">');
          });

          el_clq.replaceWith('<td id="'+id_btn+'" class="bouton-confirmer" role="button">Confirmer</td>');
          bindConfirmer();
      });


   
}


function bindConfirmer() {
    $('.bouton-confirmer').click(function() {
        el_clq = $(this);
        id_btn = $(this).attr('id');
        //console.log(el_clq.parent().find('td:first-child').text());

        //console.log($('.inp-'+id_btn));


        cols = Array();
   

        $('.inp-'+id_btn).each(function() {
            let el_text = $(this).val();
            cols.push( $( this ).val() )
            $( this ).replaceWith('<span class="el-'+id_btn+'">'+el_text+'</span>');
                      
          });

          el_clq.replaceWith('<td id="'+id_btn+'" class="bouton-modifier" role="button">Modifier</td>');
          bindModifier();
          


          $.ajax({
            url: '/localhost:3000/api/utilisateurs/'+id_btn,
            type: 'put',
            data: {
                'Nom':cols[0],
                'Prenom':cols[1],
                'Identifiant':cols[2],
                'Mot_de_passe':cols[3],
                'Email':cols[4],
                'Localisation':cols[5],
                'Role':cols[6]
            },
            success: function(response){
                console.log(response);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                console.log(errorThrown);
            }    
        });
      });
      
}