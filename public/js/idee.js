$(function() {

    $( ".submit-commentaire" ).click(function() {
        console.log("15");
        var idée = $("#votre-idée").val();
        $('.addidea').append('<br/>' + '- ' + idée);
        $('.like-texte').append('<br/>' + '<i class="fas fa-angle-up"></i> 1000');
    });

});
