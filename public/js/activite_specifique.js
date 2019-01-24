$(function() {

    $('.commentaires-image').hide();    
    //$('.ecrire-commentaire-image').hide();

    $( ".upvote" ).click(function() {
            var currentToken = $('#csrf-token').text();

            var number = parseInt($(this).prev().text()); //Nombre de like
            var id = $(this).prev().data('id'); //ID de la photo like
            var liked;


            if($(this).attr('class').includes("active")) {  
                liked=0;
                number=number-1;
                $(this).prev().text(number);
                $(this).removeClass("active");
            } else {
                liked=1;
                number=number+1;
                $(this).prev().text(number);
                $(this).addClass("active");
            }
            
            
            $.ajax({
				url: '/gerer-donnees',
				type: 'post',
				data: {
                    'action':'like',
					'like': liked,
                    'id': id,
                    '_token' : currentToken //Utilisé pour la verification csrf
                }/*,
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}*/
			});


    });

    $("#inscription-activite" ).click(function() {
        let inscrit;
        if($(this).hasClass('active')) {
            inscrit=false; 
        }else {
            inscrit=true;
        }

        var currentToken = $('#csrf-token').text();
        var idActivite = $('#id-activite').text();
        console.log("id: "+idActivite);


        $('#ajouter-article-panier').modal('show');

        
        $.ajax({
            url: '/gerer-donnees',
            type: 'post',
            data: {
                'action':'inscription-activite',
                'inscription':inscrit,
                'id-activite': idActivite,
                '_token' : currentToken //Utilisé pour la verification csrf
            },
            success: function(response){
                location.reload(); 
            }
        });

    });



    $('.image-container').hover(function() {
        $(this).find('.commentaires-image').stop().fadeToggle();
             
           if ( $(this).find('.ecrire-commentaire-image').css('visibility') == 'hidden' ) {
                $(this).find('.ecrire-commentaire-image').css({opacity: 0}).css('visibility','visible').animate({opacity: 1});
                
                
           } else {
                $(this).find('.ecrire-commentaire-image').css('visibility','hidden');
           }

    });

    $('.envoyer-commentaire-image').click(function() { 
        $el_cliq = $(this);
        let comment = $(this).parent().find('textarea').val();

        console.log($el_cliq.parent().parent().find('.commentaires-image').
        append('<p class="commentaire-image">'+ comment +'</p>'));
        id_image = $el_cliq.parent().find('.id-activite').attr('value');

        $(this).parent().find('textarea').val('');
        currentToken = $('#csrf-token').text();
        $.ajax({
            url: '/gerer-donnees',
            type: 'post',
            data: {
                'action':'ajouter-commentaire-image',
                'id-image':id_image,
                'contenu':comment,
                '_token' : currentToken //Utilisé pour la verification csrf
            },
            success: function(response){
                
            }
        });

    });






});