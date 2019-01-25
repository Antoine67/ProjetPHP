
<?php 

use App\Panier;
use App\Article;
$articles_panier = Article::select('Articles.*','Paniers.Quantité')
                                                                ->join('Paniers', 'Paniers.ID_Articles', '=', 'Articles.ID')
                                                                ->where('ID_Utilisateurs',Session::get('id'))
                                                                ->get();

                                                                
if(sizeof($articles_panier) == 0) {
    echo '<div class="center">Votre panier est vide !<br/> Allez jeter un oeil sur la <a href="/boutique">boutique<a/></div>';                                              
}else {
    echo '<h3>Votre commande :</h3>
    <form action="" method="POST">
    '; ?> @csrf <?php 
    echo '<ul>';
    foreach($articles_panier as $article_p) {
        echo '<li>'.$article_p['Nom'].'</li>
        
        
        ';
    }echo '</ul>
    
      <div id="paypal-button-container"></div>
      <button type="submit">Valider</button>  
    </form>
    
    ';

?>





 
 








<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
// Render the PayPal button
paypal.Button.render({
// Set your environment
env: 'sandbox', // sandbox | production

// Specify the style of the button
style: {
  layout: 'vertical',  // horizontal | vertical
  size:   'medium',    // medium | large | responsive
  shape:  'rect',      // pill | rect
  color:  'gold'       // gold | blue | silver | white | black
},

// Specify allowed and disallowed funding sources
//
// Options:
// - paypal.FUNDING.CARD
// - paypal.FUNDING.CREDIT
// - paypal.FUNDING.ELV
funding: {
  allowed: [
    paypal.FUNDING.CARD,
    paypal.FUNDING.CREDIT
  ],
  disallowed: []
},

// Enable Pay Now checkout flow (optional)
commit: true,

// PayPal Client IDs - replace with your own
// Create a PayPal app: https://developer.paypal.com/developer/applications/create
client: {
  sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
  production: '<insert production client id>'
},

payment: function (data, actions) {
  return actions.payment.create({
    payment: {
      transactions: [
        {
          amount: {
            total: '0.01',
            currency: 'USD'
          }
        }
      ]
    }
  });
},

onAuthorize: function (data, actions) {
  return actions.payment.execute()
    .then(function () {
      window.alert('Paiement completé !');
    });
}
}, '#paypal-button-container');
</script>

    <?php } //fin else ?>