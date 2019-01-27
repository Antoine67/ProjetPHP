
    /*
      $( ".article" ).click(function() {
        let id_article = $(this).attr("value");
        var currentToken = $('#csrf-token').text();
    
        element_clique = $(this);
        
    
        $('#ajouter-article-panier').modal('show');
    
        $('#article-nom-modal').text(element_clique.find('.nom-article').text());
        $('#article-prix-modal').text(element_clique.find('.prix-article').text());
        let imgSrc = element_clique.find('.img-article').attr('src');
        $('#article-img-modal').attr('src',imgSrc);
    
        $('#id-article-modal').val(element_clique.find('.id-article').text());
    

      });*/



      
$(function() {

  $('#suppr-article').click(function() {
    var id_article = $('#id-article').text();
    var currentToken = $('#csrf-token').text();

    $.ajax({
      url: '/gerer-donnees',
      type: 'post',
      data: {
        'action':'suppr-article',
        'id-article': id_article,
        '_token' : currentToken //Utilisé pour la verification csrf
              },
      success: function(response){
        alert('Article supprimé');
        window.location.replace("/boutique");
      }
    });

  });
});