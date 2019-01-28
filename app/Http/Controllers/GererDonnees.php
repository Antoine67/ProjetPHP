<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;

use App\Inscription;

use App\Panier;

use App\CommentaireImage;

use App\ImageActivite;

use App\Vote;

use App\Idee;

use App\Activite;

use App\Article;

use Session;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

class GererDonnees extends Controller
{
    function post() {
        $sess = Session::get('identifiant');
        if(isset($_POST) && isset($sess)) {//Si non vide et que l'utilisateur est bien connecté

            if(isset($_POST['action'])) {//Si il y a un  bien une action précisée

                switch($_POST['action']) {//Determiner quelle action

                    case('like') : {

                        if(isset($_POST['like']) && isset($_POST['id'])) {

                            if($_POST['like'] == "0") {//Enlever un like

                                $like = Like::where('ID_Utilisateurs',Session::get('id'))->where('ID_Image_activites',$_POST['id'])->delete();
                            
                            }else {//Ajouter un like

                                Like::create([
                                    'ID_Image_activites' => $_POST['id'],
                                    'ID_Utilisateurs' => Session::get('id'),
                                    'Positif' => true
                                ]);

                            }
                        }
                        break;
                    }
                    case ('inscription-activite'): {

                        if(isset($_POST['inscription']) && isset($_POST['id-activite'])) {
                          
                            if($_POST['inscription'] == "true") {
                                $alreadyExistant = sizeof(Inscription::where('ID_Utilisateurs',Session::get('id'))->where('ID_Activites',$_POST['id-activite'])->get());
                               
                                if($alreadyExistant == 0) {
                                    Inscription::create([
                                        'Date_inscription' => date("Y-m-d H:i:s"),
                                        'ID_Utilisateurs' => Session::get('id'),
                                        'ID_Activites' => $_POST['id-activite'],
                                    ]);
                                }else {
                                    return response("Erreur : impossible de trouver l'utilisateur à desincrire", 404);
                                }
                            }else {
                                Inscription::where('ID_Utilisateurs',Session::get('id'))->where('ID_Activites',$_POST['id-activite'])->delete();
                            }
                            
                        }

                        break;
                    }
                    case ('sauvegarder-panier'): {
                        if(isset($_POST['articles'])) {
                            foreach($_POST['articles'] as $article) {
                                Panier::where('ID_Articles',$article['id'])
                                        ->where('ID_Utilisateurs', Session::get('id'))->delete();
                                
                                Panier::create([
                                    'Date_creation' => date("Y-m-d H:i:s"),
                                    'ID_Utilisateurs' => Session::get('id'),
                                    'ID_Articles' => $article['id'],
                                    'Quantité' => $article['nb'],
                                ]);

                            }
                            
                        }
                        break;
                    }

                    case('vider-panier') : {
                        Panier::where('ID_Utilisateurs', Session::get('id'))->delete();
                        
                        break;
                    }
    
                    case ('ajouter-commentaire-image') : {
                        if(isset($_POST['id-image'] ) && isset($_POST['contenu'] )) {
                            CommentaireImage::create([
                                'ID_Utilisateurs' => Session::get('id'),
                                'ID_Image_Activites' => $_POST['id-image'],
                                'Contenu' => $_POST['contenu'],
                            ]);
                        }
                        break;
                    }

                    case('signaler-image-activite') : {
                        var_dump($_POST); 
                        if(isset($_POST['id-image'])) {

                            ImageActivite::where('ID',$_POST['id-image'])->update(['Valide' => 0]);;
                        }
                        break;
                    }
                    case('supprimer-image-activite') : {
                        if(isset($_POST['id-image'])) {


                            CommentaireImage::where('ID_Image_Activites',$_POST['id-image'])->delete();
                            Like::where('ID_Image_activites',$_POST['id-image'])->delete();
                            ImageActivite::where('ID',$_POST['id-image'])->delete();
                        }
                        break;
                    }
                    case ('suppr-vote-idee-activite') : {
                        if(isset($_POST['id-idee'])) {
                            Vote::where('ID_Utilisateurs',Session::get('id'))->where('ID_Idees',$_POST['id-idee'])->delete();
                        }
                        break;
                    }
                    case ('voter-idee-activite') : {
                        if(isset($_POST['id-idee'])) {
                            Vote::where('ID_Utilisateurs',Session::get('id'))->where('ID_Idees',$_POST['id-idee'])->delete();
                            Vote::create([
                                'ID_Utilisateurs' => Session::get('id'),
                                'ID_Idees' => $_POST['id-idee'],
                            ]);
                        }
                        break;
                    }
                    case ('valider-idee') : {
                        if(isset($_POST['id-idee'])) {
                            $idee = Idee::where('ID',$_POST['id-idee'])->get();
                            Idee::where('ID',$_POST['id-idee'])->update(['Etat' => 3]);
                            
                             //CREATION DE L'ACTIVIE EN BDD                       
                                Activite::create([
                                    'Titre' => $idee[0]['Titre'],
                                    'Prix' => 0,
                                    'Date_creation' => date("Y-m-d H:i:s"),
                                    'Date_realisation' => date("Y-m-d H:i:s"),
                                    'Description' => $idee[0]['Contenu'],
                                    'ID_Utilisateurs' =>Session::get('id'),
                                ]);

                            //ENVOI DU MAIL 
                                $mail = new PHPMailer(true);                              
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
                                    $mail->addAddress(Session::get('email'));     
                    
                    
                                    //Content
                                    $mail->isHTML(true);                                  
                                    $mail->Subject = 'BDE Strasbourg : Une de vos idées a été validé ! ';
                                    $mail->Body    = '<h1>Votre idée "'.$idee[0]['Titre'].'" vient d\'être validée !</h1>';
                                    $mail->AltBody = 'Une de vos idées vient tout juste d\'être validée';
                    
                                    $mail->send();
                                    echo 'La commande vient d\'être envoyé à un membre du bde ! .('.Session::get('email').')';
                                } catch (Exception $e) {
                                    echo 'Erreur lors de l\'envoi de la commande: ', $mail->ErrorInfo;
                                }

                        }
                        break;
                    }
                    case ('refuser-idee') : {
                        if(isset($_POST['id-idee'])) {
                            Idee::where('ID',$_POST['id-idee'])->update(['Etat' => 1]);
                        }
                        break;
                    }
                    case ('suppr-article') : {
                        if(isset($_POST['id-article'])) {
                            Article::where('ID',$_POST['id-article'])->delete();
                        }
                        break;
                    }

                    case('supprimer-commentaire-image-activite') : {
                        if(isset($_POST['id-comm'])) {
                            CommentaireImage::where('ID',$_POST['id-comm'])->delete();
                        }
                        break;
                    }

                }
            }
        }
    }
}
