$(function() {

    /*
    $( ".submit-commentaire" ).click(function() {
        console.log("15");
        var idée = $("#votre-idée").val();
        $('.addidea').append('<br/>' + '- ' + idée);
        $('.like-texte').append('<br/>' + '<i class="fas fa-angle-up"></i> 1000');
    });*/


    $( ".icone" ).click(function() {
        var currentToken = $('#csrf-token').text();
        var el_cliq = $(this);
        var id_init = $(this).attr('id');
        var id = id_init.substring(5);
        var action = id_init.substring(0,4);
        
        console.log('id : ' + id);
        console.log('action : ' +action);


        
        var action_post;    var fctSucces;
        if(action == 'vali') {//Valider l'idée
            action_post ='valider-idee';
            fctSucces = function() {
                el_cliq.parent().parent().appendTo("#idee-acceptees");
                el_cliq.parent().find('.icone:not(:first)').remove();
               
            }; 

        }else if(action == 'refu') {//Refuser l'idée
            action_post ='refuser-idee';
            fctSucces = function() {
                el_cliq.parent().parent().appendTo("#idee-refusees");
                el_cliq.parent().find('.icone').remove();
               
            };  
        }else if(action == 'vote') {//Voter pour l'idée
           

            if(el_cliq.hasClass('active')) {
                action_post ='suppr-vote-idee-activite';

                vote_init = parseInt(el_cliq.find('.fas').text());
                el_cliq.removeClass('active');
                el_cliq.find('.fas').text(vote_init-1);
                fctSucces = function() {}; 
            }else {
                action_post ='voter-idee-activite';
                vote_init = parseInt(el_cliq.find('.fas').text());
                el_cliq.addClass('active');
                el_cliq.find('.fas').text(vote_init+1);
                fctSucces = function() {}; 
            }


            
        }

        
        
        $.ajax({
            url: '/gerer-donnees',
            type: 'post',
            data: {
                'action':action_post,
                'id-idee':id,
                '_token' : currentToken //Utilisé pour la verification csrf
            },
            success: function(response){
                fctSucces();  
            }
        });

    });



    

});
