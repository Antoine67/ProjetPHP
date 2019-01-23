
$(function() {

    $('.classer').click (function() {
        var element_clique = $(this);


        //Si clic sur un bouton 
        if(element_clique.hasClass('active-classer')) {
            //element_clique.removeClass('active-classer');
           
        }else {
            //Si clic sur un bouton mais qu'un autre tri est déjà actif 
            if($('.classer').hasClass('active-classer')) {
                $('.classer').removeClass('active-classer');
            }

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