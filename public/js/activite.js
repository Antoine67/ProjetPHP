$(function() {

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
        var currentToken = $('#csrf-token').text();
        var idActivite = $('#id-activite').text();
        console.log("id: "+idActivite);
        var inscrit;

        if($(this).attr('class').includes("active")) {  
            inscrit = false;
        } else {
            inscrit = true;
        }

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

});