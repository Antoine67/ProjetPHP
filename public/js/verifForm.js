function verifMail(champ) {
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(champ.value))
   {
      creerErreur(champ, true);
      return false;
   }
   else
   {
      creerErreur(champ, false);
      return true;
   }
}


function creerErreur(champ, erreur) {
   var sb = $(":submit"); //Notre bouton de submit du formulaire
   if(erreur) {
      champ.style.backgroundColor = "#fc6a6a";

      sb.prop('disabled', true);
      sb.text("Champs erronés ou incomplets 😞");

   }
   else {
      champ.style.backgroundColor = "";
      sb.prop('disabled', false);
      sb.text("S'inscrire");
   }
      
}