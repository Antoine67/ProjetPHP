@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/administration.css') }}">


<?php
  //URL sur laquelle il faut cherche les images
    //Protocle (HTTP/HTTPS)
    $protocol =(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
    $url = $protocol . $_SERVER['SERVER_NAME'];

    //Si il y a port specifique (ex:localhost:8000)
    if(isset($_SERVER['SERVER_PORT']))  {  $url= $url . ':' . $_SERVER['SERVER_PORT'];  }

    $url=$url . '/';

use App\ImageActivite;
use App\Idee;

$images_acti = ImageActivite::all();

$fichiers = array();
foreach($images_acti as $img) {
    array_push($fichiers,$img['Image']);
    //echo 
}

$image_idee = Idee::all();
foreach($image_idee as $img) {
    array_push($fichiers,$img['Image']);
}



//https://www.experts-exchange.com/questions/27644877/PHP-ZipArchive-creates-corrupt-zip-file.html
date_default_timezone_set('Europe/Paris');

$dir = '';


$path
= getcwd()
. DIRECTORY_SEPARATOR
. $dir
;
if (!is_dir($path)) die("FAIL: PATH invalide -> $path");


$zip = new ZipArchive();


$archive = 'bde_images'. '.zip';


// Création de l'archive
if ($zip->open($archive, ZIPARCHIVE::CREATE)!==TRUE) die("FAIL: ZIP->OPEN -> $archive");

foreach ($fichiers as $file)
{
    if ( !is_file($file) ) continue;
    $zip->addFile($file);
}

if (!$zip->close()) die("FAIL: ZIP->CLOSE");

$fs  = filesize($archive);
$ko = number_format($fs/1000);



//Préparation et affichage du lien de téléchargement
$link
= '<a target="_blank" href="'
. $archive
. '">'
. "Téléchargez ici les photos du site (Taille : $ko Ko)"
. '</a>'
;
 echo '
 <div class="container-fluid container"> 
    <h1> Administration </h1>
    <hr/>
</div>
<div class="container-fluid container">
    <div class="col-lg-12 col-md-12 col-sm-12 categories">
        <h2 class = "titre">Lien de téléchargement</h2>
        <div class="col-lg-12 col-md-12 col-sm-12 lien">
            <div><p>Voici le lien pour télécharger toutes les photos du site : </p>'.$link.'
            </div>
        </div>
    </div>
</div>';


?> @endsection







