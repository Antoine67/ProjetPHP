<!DOCTYPE html>
<html lang="fr">
<head>
    <style>

        
    .achat{
      position: absolute;
      top: 50%;
      left: 50%;
      transform:translate(-50%, -50%);
    }

    table td, table th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    table tr:nth-child(even){background-color: #f2f2f2;}

    table tr:hover {background-color: #ddd;}

    table th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #4CAF50;
      color: white;
    }

  </style>
  <title>Payez ici!</title>
</head>
<body>


  <?php 

  use App\Panier;
  use App\Article;
  $articles_panier = Article::select('Articles.*','Paniers.Quantité')
    ->join('Paniers', 'Paniers.ID_Articles', '=', 'Articles.ID')
    ->where('ID_Utilisateurs',Session::get('id'))
    ->get();

                                                                  
  if(sizeof($articles_panier) == 0) {
      echo '<div class="center achat">Votre panier est vide !<br/> Allez jeter un oeil sur la <a href="/boutique">boutique</a></div>';                                              
  }else {
      echo '
      
      <div class="achat">
        <a href="/boutique">Poursuivre mes achats</a>
        <h3>Votre commande :</h3>
        <form method="POST">
        '; ?> @csrf <?php 
        echo '<table>';
        $prix_total=0.0;
        foreach($articles_panier as $article_p) {
          $prix_total = $prix_total + floatval($article_p['Prix'])*floatval($article_p['Quantité']);

            echo '<tr><td>'.$article_p['Nom'].'</td><td>Quantité : '.$article_p['Quantité'].'</td><td>Prix unitaire : '.$article_p['Prix'].'€</td></tr>
            
            
            ';
        }echo '</table>
          <hr/>
          <h3>Prix à payer : '.$prix_total.'€</h3>
          <br/>
          <div style="text-align:center;" id="paypal-button-container"></div>
          <button type="submit">Valider</button>  
        </form>
      </div>
      
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

</body> 
</html>