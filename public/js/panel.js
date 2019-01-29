$(document).ready(function() {

    $('#gestion_utilisateurs').DataTable( 
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
        console.log('CLICK');
        el_clq = $(this);
        id_btn = $(this).attr('id');
        //console.log(el_clq.parent().find('td:first-child').text());

        //console.log($('.inp-'+id_btn));


        var cols = Array();
   

        $('.inp-'+id_btn).each(function() {
            let el_text = $(this).val();
           
            $( this ).replaceWith('<span class="el-'+id_btn+'">'+el_text+'</span>');
            cols.push( $( this ).val() );
            console.log($(this));
            console.log($( this ).val());
          });


          console.log('COLS:');
          for (var i = 0; i < 6; i++) {
            console.log(cols[i]);
          }

          el_clq.replaceWith('<td id="'+id_btn+'" class="bouton-modifier" role="button">Modifier</td>');
          bindModifier($('#'+id_btn));
                    
          $.ajax({
            url: 'http://localhost:3000/api/utilisateurs/'+id_btn,
            type: 'put',
            dataType: 'json',
            data: {
                'Nom':cols[0],
                'Prenom':cols[1],
                'Identifiant':cols[2],
                'Mdp':cols[3],
                'Email':cols[4],
                'Localisation':cols[5],
                'Role':cols[6],
                'Token':$.cookie('token_cookie_bde')
            },

            success: function(response){
                console.log(response);
            },
            error: function(xhr, textStatus, errorThrown) { 
                console.log($.cookie('token_cookie_bde'));
                console.log('http://localhost:3000/api/utilisateurs/'+id_btn+" : ");
                console.log(errorThrown);
                console.log(xhr.responseText);
            }    
        });




      });
      
}
