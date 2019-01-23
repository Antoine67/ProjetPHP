@extends('layout')

@section('content')

<?php 

use App\Article;
use App\Panier;

//Récuperer l'url 
$protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
$url = $protocol . $_SERVER['SERVER_NAME'];

//Si il y a port specifique (ex:localhost:8000)
if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

$url=$url . '/';



$article = Article::find($id_article);


if(sizeof($article) <=0) {
    echo 'Article non trouvé :(';
}else {
    echo '
    A FAIRE PLEASE :)
    Super article : ' . $article['Nom'] . '
    
    
    ';
}

?>










@endsection