function verifMail(champ) {
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(champ.value)) {
      return creerErreur(champ, true,'Veuillez entrez une adresse e-mail correcte');
   }
   else {
      return creerErreur(champ, false);
   }
}


function verifMdp(champ) {
   if(champ.value.length <=8) {
      return creerErreur(champ, true, 'Le mot de passe doit faire plus de 8 caractères');
   } else if (!(/[A-Z]/.test(champ.value))){
      return creerErreur(champ, true, 'Le mot de passe doit contenir au moins 1 majuscule');
   } else if (!(/[1-9]/.test(champ.value))){
      return creerErreur(champ, true, 'Le mot de passe doit contenir au moins 1 chiffre');
   }
   else {
      return creerErreur(champ, false);
   }
}

function verifConfMdp(champ) {
   if(champ.value == $("#mdpp").val()) {
      return creerErreur(champ, false);
   } else {
      return creerErreur(champ, true, 'Les mots de passe ne correspondent pas');
   }
}




function creerErreur(champ, erreur, message) {
   var sb = $(".butbut"); //Notre bouton de submit du formulaire

   

   if(erreur) {
      champ.style.backgroundColor = "#f23232";
      $(champ).prev().html(message);
      sb.prop('disabled', true);
      sb.text("Champs erronés");

      return false;
   }
   else {
      $(champ).prev().html('');
      champ.style.backgroundColor = "";
      sb.prop('disabled', false);
      sb.html('<i class="fas fa-check"></i>Changer');
      return true;
   }
      
}