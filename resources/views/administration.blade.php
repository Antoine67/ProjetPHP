
@extends('layout')

@section('content')


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

// A GOOD PATH ON MY SERVER
$path
= getcwd()
. DIRECTORY_SEPARATOR
. $dir
;
if (!is_dir($path)) die("FAIL: PATH invalide -> $path");

// INSTANTIATE THE OBJECT
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
 echo $link;


?> @endsection







