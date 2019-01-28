<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Panier;
use App\Article;
use App\Commande;
use Session;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class AchatController extends Controller
{
    function get() {


        return view('achat');
    }

    function post() {
        $emailBDE = 'antoine.mohr@viacesi.fr';


        $sess = Session::get('identifiant');
        if(isset($_POST) && isset($sess)) {

            $articles = Article::select('Articles.*','Paniers.Quantité')
                                ->join('Paniers', 'Paniers.ID_Articles', '=', 'Articles.ID')
                                ->where('ID_Utilisateurs',Session::get('id'))
                                ->get();
            
            $id_commande = rand(0, 99999);
            while(sizeof(Commande::where('ID_Commandes',$id_commande)->get())!=0) {
                $id_commande = rand(0, 99999);
            }
            if(sizeof($articles)==0) {
                echo 'Erreur : aucun article dans le panier !';
            }else{
                $body_commande = '<ul>';
                foreach($articles as $article) {
                    //On crée une ligne de commande pour chaque Article
                    Commande::create([
                        'Date_commande' => date("Y-m-d H:i:s"),
                        'ID_Utilisateurs' => Session::get('id'),
                        'ID_Articles' => $article['ID'],
                        'Quantité' => $article['Quantité'],
                        'Etat' => 0,
                        'ID_Commandes' => $id_commande,
                        'Prix_total' => $article['Quantité'] * $article['Prix'],
                    ]);
    
                    $body_commande = $body_commande . '<li>['.$article['ID'].'] -> '.$article['Nom'].'en quantit&#233; de '.$article['Quantité'].' pour un prix de '.$article['Prix'].' euros</li>';

                    //On ++ le compteur de vente des articles
                    Article::where('ID', $article['ID'])
                    ->update(['Vendu' => intval($article['Vendu'])+$article['Quantité']]);
    
                    //On vide le panier
                    Panier::where('ID_Articles',$article['ID'])->where('ID_Utilisateurs',Session::get('id'))->delete();
    
                    
                }
                $body_commande =$body_commande . '</ul>';
                $body_commande = $body_commande . '<h2>command&#233 par l\'utilisateur '. Session::get('id');
    
                
    
    
    
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    //Server settings
                    $mail->isSMTP();                                     
                    $mail->Host = 'smtp.gmail.com';  
                    $mail->SMTPAuth = true;                               
                    $mail->Username = 'bde.cesi.exia@gmail.com';                
                    $mail->Password = 'SuperBDE67000?';                           
                    $mail->SMTPSecure = 'ssl';                            
                    $mail->Port = 465;                                  
    
                    //Recipients
                    $mail->setFrom('bde.site@cesi.fr', 'Mailer');
                    $mail->addAddress(env("ADRESSE_EMAIL"));     
    
    
                    //Content
                    $mail->isHTML(true);                                  
                    $mail->Subject = 'Commande numero '.$id_commande;
                    $mail->Body    = '<h1>Commande n&#176;'. $id_commande .'</h1>' .$body_commande ;
                    $mail->AltBody = 'Commande numero '.$id_commande.'a été passée';
    
                    $mail->send();
                    echo 'La commande vient d\'être envoyé à un membre du bde ! ('.env("ADRESSE_EMAIL").')';
                
                } catch (Exception $e) {
                    echo 'Erreur lors de l\'envoi de la commande: ', $mail->ErrorInfo;
                }
            }
            
        }
        
    }
}
