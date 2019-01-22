$(function() {


    $('.moins-nb').click(function() { //Boutons pour diminuer la quantité d'article à acheter
        var nbArticles = parseInt($(this).next().text());
        nbArticles-=1;
        $(this).next().text(nbArticles);

        if(nbArticles <=0 ) {
            $(this).parents(".article-panier").remove();

            
            //AJAX Supression du panier à faire
        }

    
        if($("#panier-contenu .article-panier").length <= 0) {
            console.log('panier vide !');
            $("#panier-contenu").html("<div class='center'>Votre panier est vide !<br/> Allez jeter un oeil sur la <a href='/boutique'>boutique<a/></div>");
         }

         majPrixQuantite();

    });



    $('.plus-nb').click(function() { //Boutons pour augmenter la quantité d'article à acheter
        var nbArticles = parseInt($(this).prev().text());
        nbArticles+=1;
        $(this).prev().text(nbArticles);

        majPrixQuantite();
    });




    $('#panier-vider').click(function() { //Vider le panier
       

    });

    $('#panier-sauvegarder').click(function() { //Sauvegarder le panier
       

    });

    $('#panier-payer').click(function() { //Passer au paiement
       

    });

});

function majPrixQuantite() {
    nbArticlesTotal = 0;    prixArticlesTotal=0;
    $('.article-panier .nb-article').each(function() {
        nbArticlesTotal+=parseInt($(this).text());
    });

    $('.article-panier .prix-article').each(function() {
        prixArticlesTotal+=parseFloat($(this).text());
    });


    $('#qte-totale').text(nbArticlesTotal);
    $('#prix-total').text(prixArticlesTotal);
};




