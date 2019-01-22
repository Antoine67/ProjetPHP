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



      $('.tri').click (function() {
        var element_clique = $(this);

        //Si clic sur l'element alors qu'il est déjà actif => on réaffiche tous les articles
        if(element_clique.hasClass('active-tri')) {
          element_clique.removeClass('active-tri');
          $('.article').show();
          return;
        }

        //Si clic sur un bouton mais qu'un autre tri est déjà actif on l'annule
        if($('.tri').hasClass('active-tri')) {
          $('.tri').removeClass('active-tri');
          $('.article').show();
        }

        //Si clic sur un bouton mais qu'un autre tri est déjà actif on l'annule     
        if(element_clique.hasClass('active-tri')) {
          element_clique.removeClass('active-tri');
          $('.article').show();
        }else {
          var categorie = element_clique.attr("data");
          element_clique.addClass('active-tri');
          $('.article').not('.' + categorie).hide();
        }

      });

});
