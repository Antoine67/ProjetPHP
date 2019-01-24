<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\Panier;


use Session;

class BoutiqueController extends Controller
{
    function get() {
        return view('boutique');
    }

    function categorieSpecifique($categorie) {
        return view('boutique_categorie')->with('categorie',$categorie);
    }

    function articleSpecifique($id_article) {
        return view('boutique_article')->with('id_article',$id_article);
    }

    function ajoutArticlePanier() {
        $sess = Session::get('identifiant');
        if(isset($_POST) && isset($sess)) {
            if(isset($_POST['id-article']) && isset($_POST['quantite'])) {
                if(!is_numeric($_POST['id-article']) || !is_numeric($_POST['quantite']) ) {
                    echo 'Erreur champ numérique mal renseigné';
                    exit;
                }

                Panier::where('ID_Utilisateurs',Session::get('id'))->where('ID_Articles',$_POST['id-article'])->delete();


                Panier::create([
                    'Quantité' => $_POST['quantite'],
                    'Date_creation' => date("Y-m-d H:i:s"),
                    'ID_Articles' => $_POST['id-article'],
                    'ID_Utilisateurs' =>Session::get('id'),
                ]);
                return redirect('/boutique');

            }
        }
    }

    function rechercheArticle() {
        return view('recherche_article');
    }

    function post() {
        $sess = Session::get('identifiant');
        if(isset($_POST) && isset($sess)) {
            if(isset($_POST['id-article']) && isset($_POST['quantite'])) {

                $article = Article::find($_POST['id-article']);

                //Si existe déjà dans le panier
                Panier::where('ID_Utilisateurs',Session::get('id'))
                        ->where('ID_Articles',$_POST['id-article'])
                        ->delete();

                if($article) {
                    Panier::create([
                        'Date_creation' => date("Y-m-d H:i:s"),
                        'ID_Utilisateurs' => Session::get('id'),
                        'ID_Articles' => $_POST['id-article'],
                        'Quantité' => $_POST['quantite'],
                    ]);
                    return view('boutique')->with('message','<i class="fa fa-check"></i> '.$article['Nom'].' ajouté au panier !');
                }
            }
        }
    }
}
