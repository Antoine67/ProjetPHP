$(function() {

    var urlloc = 'http://localhost:3000/api/utilisateurs/';
    var id = $("#idtexte").text();
    var token = $("#tokentexte").text();
    var xhr = new XMLHttpRequest();
    console.log(id);
    console.log(token);
    document.cookie = "token_cookie_bde="+token;

    $.ajax({

        url: urlloc+id,
        type: 'get',
        crossDomain: true,
        dataType: 'json',
        contentType: 'json',
         xhrFields: {
                withCredentials: true
             },
        
        data: {
            'Prenom':prenom,
            'Nom':nom,
            'Identifiant':identifiant,
            'Mot_de_passe':mdp,
            'Email':email,
            'Localisation':localisation,

        },

          headers: {
            'content-Type': 'application/json',
            "Accept": "/",
            "Cache-Control": "no-cache",
            "Access-Control-Allow-Origin": "*",

            },


        processData: false,
        success: function(response){

        }
    });



    $( "#modifierprenom" ).click(function() {

        var prenom = $("#newprenom").val();
        var nom = $("#nomtexte").text();
        var identifiant = $("#identifianttexte").text();
        var mdp = $("#mdptexte").text();
        var email = $("#emailtexte").text();
        var localisation = $("#localisationtexte").text();

        console.log(prenom);
        console.log(nom);
        console.log(identifiant);
        console.log(mdp);
        console.log(email);
        console.log(localisation);

        var champ_update = $(this).attr('id');
            
            $.ajax({
                url: urlloc+id,
                type: 'put',
                xhrFields: {
                     withCredentials: false
                    },
                data: {
                    'Prenom':prenom,
                    'Nom':nom,
                    'Identifiant':identifiant,
                    'Mot_de_passe':mdp,
                    'Email':email,
                    'Localisation':localisation,
                },
                success: function(response){
                    console.log("Prénom modifié mdr");
                    
                }
            });


    });

    $( "#modifiernom" ).click(function() {

        var prenom = $("#prenomtexte").text();

        var identifiant = $("#identifianttexte").text();
        var mdp = $("#mdptexte").text();
        var email = $("#emailtexte").text();
        var localisation = $("#localisationtexte").text();

        var champ_update = $(this).attr('id');
            
            $.ajax({
                url: '/profil',
                type: 'put',
                data: {
                    'Prenom':prenom,
                    'Nom':nom,
                    'Identifiant':identifiant,
                    'Mot_de_passe':mdp,
                    'Email':email,
                    'Localisation':localisation,
                },
                success: function(response){
                    
                }
            });


    });

    $( "#modifieridentifiant" ).click(function() {

        var prenom = $("#prenomtexte").text();
        var nom = $("#nomtexte").text();

        var mdp = $("#mdptexte").text();
        var email = $("#emailtexte").text();
        var localisation = $("#localisationtexte").text();

        var champ_update = $(this).attr('id');
            
            $.ajax({
                url: '/profil',
                type: 'put',
                data: {
                    'Prenom':prenom,
                    'Nom':nom,
                    'Identifiant':identifiant,
                    'Mot_de_passe':mdp,
                    'Email':email,
                    'Localisation':localisation,
                },
                success: function(response){
                    
                }
            });


    });

    $( "#modifiermdp" ).click(function() {

        var prenom = $("#prenomtexte").text();
        var nom = $("#nomtexte").text();
        var identifiant = $("#identifianttexte").text();

        var email = $("#emailtexte").text();
        var localisation = $("#localisationtexte").text();

        var champ_update = $(this).attr('id');
            
            $.ajax({
                url: '/profil',
                type: 'put',
                data: {
                    'Prenom':prenom,
                    'Nom':nom,
                    'Identifiant':identifiant,
                    'Mot_de_passe':mdp,
                    'Email':email,
                    'Localisation':localisation,
                },
                success: function(response){
                    
                }
            });


    });

    $( "#modifieremail" ).click(function() {

        var prenom = $("#prenomtexte").text();
        var nom = $("#nomtexte").text();
        var identifiant = $("#identifianttexte").text();
        var mdp = $("#mdptexte").text();

        var localisation = $("#localisationtexte").text();

        var champ_update = $(this).attr('id');
            
            $.ajax({
                url: '/profil',
                type: 'put',
                data: {
                    'Prenom':prenom,
                    'Nom':nom,
                    'Identifiant':identifiant,
                    'Mot_de_passe':mdp,
                    'Email':email,
                    'Localisation':localisation,
                },
                success: function(response){
                    
                }
            });


    });

    $( "#modifierlocalisation" ).click(function() {

        var prenom = $("#prenomtexte").text();
        var nom = $("#nomtexte").text();
        var identifiant = $("#identifianttexte").text();
        var mdp = $("#mdptexte").text();
        var email = $("#emailtexte").text();


        var champ_update = $(this).attr('id');
            
            $.ajax({
                url: '/profil',
                type: 'put',
                data: {
                    'Prenom':prenom,
                    'Nom':nom,
                    'Identifiant':identifiant,
                    'Mot_de_passe':mdp,
                    'Email':email,
                    'Localisation':localisation,
                },
                success: function(response){
                    
                }
            });


    });

});
