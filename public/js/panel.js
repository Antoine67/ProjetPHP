$(document).ready(function() {
    console.log('doc rdy');
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
        console.log($('.inp-'+id_btn));
        
        $('.inp-'+id_btn).each(function() {
            let el_text = $(this).val();
            $( this ).replaceWith('<span class="el-'+id_btn+'">'+el_text+'</span>');
            console.log($(this).parent());
           
          });

          el_clq.replaceWith('<td id="'+id_btn+'" class="bouton-modifier" role="button">Modifier</td>');
          bindModifier();

          $.ajax({
            url: '/localhost:3000/api',
            type: 'put',
            data: {
                'Nom':nom,
                'Prenom':prenom,
                'Identifiant':identifiant,
                'Mot_de_passe':mdp,
                'Email':email,
                'Localisation':localisation,
                'Role':role
            },
            success: function(response){
                
            }
        });
      });
      
}