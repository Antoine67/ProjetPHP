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

        majPrixQuantite();
    });

    $('#panier-sauvegarder').click(function() { //Sauvegarder le panier
           sauvegarder();
    });

    $('#panier-payer').click(function() { //Passer au paiement
       
        sauvegarder();
        window.location.assign('/achat')
    });

    

});

function majPrixQuantite() {
    qteArticlesTotal = 0;    prixArticlesTotal=0;


    $('.article-panier').each(function() {
        var nbArticles = parseInt($(this).find('.nb-article').text());
        var prix =  parseFloat($(this).find('.prix-article').text());
        qteArticlesTotal+=nbArticles;
        prixArticlesTotal+=prix*nbArticles;
    });

    $('#qte-totale').text(qteArticlesTotal);
    $('#prix-total').text(prixArticlesTotal.toFixed(2));
};


function sauvegarder () {

}




