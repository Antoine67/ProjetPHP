$(document).ready(function() {
    console.log('doc rdy');
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

    bindModifier();
    bindConfirmer();
} );


function bindModifier() {
    $('.bouton-modifier').click(function() {
        el_clq = $(this);
        id_btn = $(this).attr('id');
        console.log('.el-'+id_btn);
        console.log($('.el-'+id_btn));
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
            $( this ).replaceWith('<td class="bouton-modifier" role="button">'+$(this).text()+'</td>');
          });

          el_clq.replaceWith('<td id="conf-'+id_btn+'" class="bouton-confirmer">Confirmer</td>');
          bindModifier();
      });
}
