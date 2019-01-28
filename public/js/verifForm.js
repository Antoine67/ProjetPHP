

var erreur_gnl;

$(function() {
   $('#errGnle').hide();
   
});


function verifMail(el) {
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(el.val())) {
      erreur_gnl = 'Veuillez entrer une adresse e-mail valide';
      return false;
   }
   else {
      return true;
   }
}


function verifMdp(el) {
   if(el.val().length <=8) {
      erreur_gnl = 'Le mot de passe doit faire plus de 8 caractères';
      return false;
   } else if (!(/[A-Z]/.test(el.val()))){
      erreur_gnl = 'Le mot de passe doit contenir au moins 1 majuscule';
      return false;
   } else if (!(/[1-9]/.test(el.val()))){
      erreur_gnl = 'Le mot de passe doit contenir au moins 1 chiffre';
      return false;
   }
   else {
      return true;
   }
}

function verifConfMdp(el) {
   if(el.val() == $("#mdp").val()) {
      return true;
   } else {
      erreur_gnl = 'Les mots de passe ne correspondent pas';
      return false;
   }
   
}

$( "#inscription" ).submit(function( event ) {
   if(!verifMail($('#email'))) {
      afficherErrGnl();
      event.preventDefault();
      return;
   }
   if(!verifMdp($('#mdp'))) {
      afficherErrGnl();
      event.preventDefault();
      return;
   }
   if(!verifConfMdp($('#mdpconf'))) {
      afficherErrGnl();
      event.preventDefault();
      return;
   }
   afficherErrGnl();
});
  


function afficherErrGnl() {
   console.log(erreur_gnl);
   if(erreur_gnl.length == 0) {
      $('#errGnle').hide();
      return;
   }
   $('#errGnle').html('<i class="fas fa-exclamation-circle"></i> '+erreur_gnl);
   $('#errGnle').show();
}