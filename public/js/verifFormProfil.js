
function verifMail(el) {
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(el.val())) {
      
      return false;
   }
   else {
      return true;
   }
}


function verifMdp(el) {
   if(el.val().length <=8) {
      return false;
   } else if (!(/[A-Z]/.test(el.val()))){
      return false;
   } else if (!(/[1-9]/.test(el.val()))){
      return false;
   }
   else {
      return true;
   }
}

function verifConfMdp(el) {
   if(el.val() == $("#mdpp").val()) {
      return true;
   } else {
      return false;
   }
   
}

$( "#inscription" ).submit(function( event ) {
   if(!verifMail($('#email'))) {
      event.preventDefault();
      return;
   }
   if(!verifMdp($('#mdp'))) {
      event.preventDefault();
      return;
   }
   if(!verifConfMdp($('#mdpconf'))) {
      event.preventDefault();
      return;
   }
});
  

