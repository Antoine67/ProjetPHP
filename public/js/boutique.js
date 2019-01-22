$(function() {
  console.log('doc chargé');
    //Au dessus d'une div contenant une image + un texte
    $( ".imagetexte" ).hover(function() {
          $(this).animate({
            opacity: '0.5',
          });
        
        $(this).children('.text').each(function () {
            $( this ).stop(true,true).css( 'opacity' , '1' );
        });

      });

       //En dehors
      $( ".imagetexte" ).mouseleave(function() {
        $(this).stop(true,true).animate({
            opacity: '1',
          });
        $(this).children('.text').each(function () {
            $( this ).stop(true,true).css( 'opacity' , '0' );
        });
      });

      $('#triprix').click(function() {
        var data = $('.article');

        console.log(data);

      });




      $('#triMateriel').click (function() {
        if($('.article').css('display' , 'none'))  {
        $('.article').css('display' , 'initial')
        }else {
          $('.article').css('display' , 'none'); // cache tous les articles
          //affiche uniquement ceux avec classe "materielinformatique"
        }
        

      });

       
   
});
