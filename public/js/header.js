$(function() {


    $('.moins-nb').click(function() { //Boutons pour diminuer la quantité d'article à acheter
        var nbArticles = parseInt($(this).next().text());
        nbArticles-=1;
        $(this).next().text(nbArticles);

        if(nbArticles <=0 ) {
            $(this).parents(".article-panier").remove();
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
        viderPanier();
        majPrixQuantite();
    });

    $('#panier-sauvegarder').click(function() { //Sauvegarder le panier
        sauvegarder();
    });

    $('#panier-payer').click(function() { //Passer au paiement
       
        sauvegarder();
        window.location.assign('/achat')
    });

    if($.cookie("accepter") != 1) {
        $('#panel-cookie').modal('show');
    }

    $('#accepter-cookie').click(function() { //Accepte les cookies
        $.cookie("accepter", "1");
        $('#panel-cookie').modal('hide');
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
    var currentToken = $('#csrftoken').text();

    var articles = Array();
    $('.article-panier').each(function() {
        let id =$(this).attr('id');
        var idArticle = parseInt(id.substring(8));
        var nbArticle = parseInt($(this).find('.nb-article').text());

        let article = {id:idArticle, nb:nbArticle};
        articles.push(article);
    });

   
    $.ajax({
        url: '/gerer-donnees',
        type: 'post',
        data: {
            'action':'sauvegarder-panier',
            'articles':articles,
            '_token' : currentToken //Utilisé pour la verification csrf
        },
        success: function(response){
            console.log('sauvegardé :'+articles);
    
        }
    });
}


function viderPanier() {
    $('#panier-contenu').empty();
    $("#panier-contenu").html("<div class='center'>Votre panier est vide !<br/> Allez jeter un oeil sur la <a href='/boutique'>boutique</a></div>");
    
    var currentToken = $('#csrftoken').text();

    $.ajax({
        url: '/gerer-donnees',
        type: 'post',
        data: {
            'action':'vider-panier',
            '_token' : currentToken //Utilisé pour la verification csrf
        },
        success: function(response){
           console.log('panier vidé !')
    
        }
    });

}




