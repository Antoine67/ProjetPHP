// Equivalent à document.ready()
$(function() {
    //Au dessus d'une div contenant une image + un texte
    $( ".imagetexte" ).hover(function() {
          $(this).animate({
            opacity: '0.5',
          });
        
        $(this).children('.text').each(function () {
            $( this ).stop(true,true).css( 'opacity' , '1' );
        });

      });
  opacity: 0.5;
       //En dehors
      $( ".imagetexte" ).mouseout(function() {
        $(this).stop(true,true).animate({
            opacity: '1',
          });
        $(this).children('.text').each(function () {
            $( this ).stop(true,true).css( 'opacity' , '0' );
        });
      });

});