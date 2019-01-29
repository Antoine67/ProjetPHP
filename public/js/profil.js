
function sha1(str) {
  //  discuss at: http://phpjs.org/functions/sha1/
  // original by: Webtoolkit.info (http://www.webtoolkit.info/)
  // improved by: Michael White (http://getsprink.com)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //    input by: Brett Zamir (http://brett-zamir.me)
  //  depends on: utf8_encode
  //   example 1: sha1('Kevin van Zonneveld');
  //   returns 1: '54916d2e62f65b3afa6e192e6a601cdbe5cb5897'

  var rotate_left = function(n, s) {
    var t4 = (n << s) | (n >>> (32 - s));
    return t4;
  };

  /*var lsb_hex = function (val) { // Not in use; needed?
    var str="";
    var i;
    var vh;
    var vl;

    for ( i=0; i<=6; i+=2 ) {
      vh = (val>>>(i*4+4))&0x0f;
      vl = (val>>>(i*4))&0x0f;
      str += vh.toString(16) + vl.toString(16);
    }
    return str;
  };*/

  var cvt_hex = function(val) {
    var str = '';
    var i;
    var v;

    for (i = 7; i >= 0; i--) {
      v = (val >>> (i * 4)) & 0x0f;
      str += v.toString(16);
    }
    return str;
  };

  var blockstart;
  var i, j;
  var W = new Array(80);
  var H0 = 0x67452301;
  var H1 = 0xEFCDAB89;
  var H2 = 0x98BADCFE;
  var H3 = 0x10325476;
  var H4 = 0xC3D2E1F0;
  var A, B, C, D, E;
  var temp;

  var str_len = str.length;

  var word_array = [];
  for (i = 0; i < str_len - 3; i += 4) {
    j = str.charCodeAt(i) << 24 | str.charCodeAt(i + 1) << 16 | str.charCodeAt(i + 2) << 8 | str.charCodeAt(i + 3);
    word_array.push(j);
  }

  switch (str_len % 4) {
    case 0:
      i = 0x080000000;
      break;
    case 1:
      i = str.charCodeAt(str_len - 1) << 24 | 0x0800000;
      break;
    case 2:
      i = str.charCodeAt(str_len - 2) << 24 | str.charCodeAt(str_len - 1) << 16 | 0x08000;
      break;
    case 3:
      i = str.charCodeAt(str_len - 3) << 24 | str.charCodeAt(str_len - 2) << 16 | str.charCodeAt(str_len - 1) <<
        8 | 0x80;
      break;
  }

  word_array.push(i);

  while ((word_array.length % 16) != 14) {
    word_array.push(0);
  }

  word_array.push(str_len >>> 29);
  word_array.push((str_len << 3) & 0x0ffffffff);

  for (blockstart = 0; blockstart < word_array.length; blockstart += 16) {
    for (i = 0; i < 16; i++) {
      W[i] = word_array[blockstart + i];
    }
    for (i = 16; i <= 79; i++) {
      W[i] = rotate_left(W[i - 3] ^ W[i - 8] ^ W[i - 14] ^ W[i - 16], 1);
    }

    A = H0;
    B = H1;
    C = H2;
    D = H3;
    E = H4;

    for (i = 0; i <= 19; i++) {
      temp = (rotate_left(A, 5) + ((B & C) | (~B & D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B, 30);
      B = A;
      A = temp;
    }

    for (i = 20; i <= 39; i++) {
      temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B, 30);
      B = A;
      A = temp;
    }

    for (i = 40; i <= 59; i++) {
      temp = (rotate_left(A, 5) + ((B & C) | (B & D) | (C & D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B, 30);
      B = A;
      A = temp;
    }

    for (i = 60; i <= 79; i++) {
      temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B, 30);
      B = A;
      A = temp;
    }

    H0 = (H0 + A) & 0x0ffffffff;
    H1 = (H1 + B) & 0x0ffffffff;
    H2 = (H2 + C) & 0x0ffffffff;
    H3 = (H3 + D) & 0x0ffffffff;
    H4 = (H4 + E) & 0x0ffffffff;
  }

  temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);
  return temp.toLowerCase();
}


$(function() {

    var urlloc = 'http://localhost:3000/api/utilisateurs/';
    var id = $("#idtexte").text();
    var token = $("#tokentexte").text();
    var mdpv = $("#mdpv").text();
    var xhr = new XMLHttpRequest();
    console.log(id);
    console.log(token);
    console.log(mdpv);


    $( "#modifierprenom" ).click(function() {

        var prenom = $("#newprenom").val();
        var nom = $("#nomtexte").text();
        var identifiant = $("#identifianttexte").text();
        var mdp = $("#mdptexte").text();
        var email = $("#emailtexte").text();
        var localisation = $("#localisationtexte").text();
        var role = $("#roletexte").text();


        console.log(prenom);
        console.log(nom);
        console.log(identifiant);
        console.log(mdpv);
        console.log(email);
        console.log(localisation);

        var champ_update = $(this).attr('id');
            
            $.ajax({
                url: urlloc+id,
                type: 'put',
                dataType: 'json',
                data: {
                    'Nom':nom,
                    'Prenom':prenom,
                    'Identifiant':identifiant,
                    'Mdp':mdpv,
                    'Email':email,
                    'Localisation':localisation,
                    'Role':role,
                    'Token':$.cookie('token_cookie_bde')
                },
                success: function(response){
                    console.log("Prénom modifié mdr");
                    
                }
            });

            location.reload();

    });

    $( "#modifiernom" ).click(function() {

        var prenom = $("#prenomtexte").text();
        var nom = $("#newnom").val();
        var identifiant = $("#identifianttexte").text();
        var mdp = $("#mdptexte").text();
        var email = $("#emailtexte").text();
        var localisation = $("#localisationtexte").text();
        var role = $("#roletexte").text();

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
                dataType: 'json',
                data: {
                    'Nom':nom,
                    'Prenom':prenom,
                    'Identifiant':identifiant,
                    'Mdp':mdpv,
                    'Email':email,
                    'Localisation':localisation,
                    'Role':role,
                    'Token':$.cookie('token_cookie_bde')
                },
                success: function(response){
                    console.log("Nom modifié mdr");
                    
                }
            });

            location.reload();
    });

    $( "#modifieridentifiant" ).click(function() {

        var prenom = $("#prenomtexte").text();
        var nom = $("#nomtexte").text();
        var identifiant = $("#newidentifiant").val();
        var mdp = $("#mdptexte").text();
        var email = $("#emailtexte").text();
        var localisation = $("#localisationtexte").text();
        var role = $("#roletexte").text();

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
                dataType: 'json',
                data: {
                    'Nom':nom,
                    'Prenom':prenom,
                    'Identifiant':identifiant,
                    'Mdp':mdpv,
                    'Email':email,
                    'Localisation':localisation,
                    'Role':role,
                    'Token':$.cookie('token_cookie_bde')
                },
                success: function(response){
                    console.log("Prénom modifié mdr");
                    
                }
            });

            location.reload();
    });

    $( "#modifiermdp" ).click(function() {

        var prenom = $("#prenomtexte").text();
        var nom = $("#nomtexte").text();
        var identifiant = $("#identifianttexte").text();
        var mdp = $("#mdpp").text();
        var mdp2 = $("#newmdp").text();
        var email = $("#emailtexte").text();
        var localisation = $("#localisationtexte").text();
        var role = $("#roletexte").text();
        console.log(mdp);

        if(!verifMdp( $("#mdpp"))){
            alert("Mot de passe incorect");
            return;
        }

        if(!verifConfMdp( $("#newmdp"))){
            alert("Mot de passe pas correspondant");
            return;
        }
        var mdp = $("#mdpp").val();
        mdp = sha1(mdp);

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
                dataType: 'json',
                data: {
                    'Nom':nom,
                    'Prenom':prenom,
                    'Identifiant':identifiant,
                    'Mdp':mdp,
                    'Email':email,
                    'Localisation':localisation,
                    'Role':role,
                    'Token':$.cookie('token_cookie_bde')
                },
                success: function(response){
                    console.log("Prénom modifié mdr");
                    
                }
            });

            location.reload();
    });

    $( "#modifieremail" ).click(function() {

        var prenom = $("#prenomtexte").text();
        var nom = $("#nomtexte").text();
        var identifiant = $("#identifianttexte").text();
        var mdp = $("#mdptexte").text();
        var email = $("#newemail").val();
        var localisation = $("#localisationtexte").text();
        var role = $("#roletexte").text();

        if(!verifMail( $("#newemail"))){
            alert("Adresse email incorecte");
            return;
        }

        

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
                dataType: 'json',
                data: {
                    'Nom':nom,
                    'Prenom':prenom,
                    'Identifiant':identifiant,
                    'Mdp':mdpv,
                    'Email':email,
                    'Localisation':localisation,
                    'Role':role,
                    'Token':$.cookie('token_cookie_bde')
                },
                success: function(response){
                    console.log("Prénom modifié mdr");
                    
                }
            });

            location.reload();
    });

   $( "#modifierlocalisation" ).click(function() {

        var prenom = $("#prenomtexte").text();
        var nom = $("#nomtexte").text();
        var identifiant = $("#identifianttexte").text();
        var mdp = $("#mdptexte").text();
        var email = $("#emailtexte").text();
        var localisation = $("#newlocalisation").val();
        var role = $("#roletexte").text();

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
                dataType: 'json',
                data: {
                    'Nom':nom,
                    'Prenom':prenom,
                    'Identifiant':identifiant,
                    'Mdp':mdpv,
                    'Email':email,
                    'Localisation':localisation,
                    'Role':role,
                    'Token':$.cookie('token_cookie_bde')
                },
                success: function(response){
                    console.log("Prénom modifié mdr");
                    
                }
            });
            location.reload();

    });
});

