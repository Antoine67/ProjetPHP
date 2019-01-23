$(function() {
  var initialArticlesDiv = $('.articles').clone();

    actualiserArticleHover();

      $('#close-message').click(function() {
        var element_clique = $(this);
        $(this).parent().fadeOut();

      

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

        //Si clic sur un bouton 
        if(element_clique.hasClass('active-tri')) {
          element_clique.removeClass('active-tri');
          $('.article').show();
        }else {
          var categorie = element_clique.attr("value");
          element_clique.addClass('active-tri');
          $('.article').not('.' + categorie).hide();
        }

      });



      $('.classer').click (function() {
        var element_clique = $(this);

        //Si clic sur l'element alors qu'il est déjà actif => on réaffiche tous les articles
        if(element_clique.hasClass('active-classer')) {
          element_clique.removeClass('active-classer');
          $('.article').show();
          return;
        }

        //Si clic sur un bouton mais qu'un autre tri est déjà actif on l'annule
        if($('.classer').hasClass('active-classer')) {
          $('.classer').removeClass('active-classer');
          $('.article').show();
        }


        //Si clic sur un bouton 
        if(element_clique.hasClass('active-classer')) {
          element_clique.removeClass('active-classer');
          $('articles').replaceWith(initialArticlesDiv);
        }else {

          var filtre = element_clique.attr("value");
          element_clique.addClass('active-classer');

          if(filtre=="Nom") {
            var $divs = $(".article");
            var alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
              return $(a).find(".nom-article").text().sansAccent() > $(b).find(".nom-article").text().sansAccent();
            });
            $(".articles").html(alphabeticallyOrderedDivs);

          }else if (filtre == "Prix"){
            var $divs = $(".article");
            var alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
              return parseFloat($(a).find(".prix-article").text().sansAccent()) > parseFloat($(b).find(".prix-article").text().sansAccent());
            });
            $(".articles").html(alphabeticallyOrderedDivs);
          }

        }
        actualiserArticleHover();
      });


      $( ".imagetexte" ).click(function() {
        let id_article = $(this).attr("value");
        var currentToken = $('#csrf-token').text();
    
        element_clique = $(this);
        
    
        $('#ajouter-article-panier').modal('show');
    
        $('#article-nom-modal').text(element_clique.find('.nom-article').text());
        $('#article-prix-modal').text(element_clique.find('.prix-article').text());
        let imgSrc = element_clique.find('.img-article').attr('src');
        $('#article-img-modal').attr('src',imgSrc);
    
        $('#id-article-modal').val(element_clique.find('.id-article').text());
    
       
    
    
    
      });
    



});



String.prototype.sansAccent = function(){
  var accent = [
      /[\300-\306]/g, /[\340-\346]/g, // A, a
      /[\310-\313]/g, /[\350-\353]/g, // E, e
      /[\314-\317]/g, /[\354-\357]/g, // I, i
      /[\322-\330]/g, /[\362-\370]/g, // O, o
      /[\331-\334]/g, /[\371-\374]/g, // U, u
      /[\321]/g, /[\361]/g, // N, n
      /[\307]/g, /[\347]/g, // C, c
  ];
  var noaccent = ['A','a','E','e','I','i','O','o','U','u','N','n','C','c'];
   
  var str = this;
  for(var i = 0; i < accent.length; i++){
      str = str.replace(accent[i], noaccent[i]);
  }
   
  return str;
}

function actualiserArticleHover() {
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




 /*
    $.ajax({
      url: '/gerer-donnees',
      type: 'post',
      data: {
          'action':'ajouter-article-panier',
          'id-article':id_article,
          '_token' : currentToken //Utilisé pour la verification csrf
      },
      success: function(response){
          
      }
  });*/

}