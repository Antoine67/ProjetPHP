@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/acceuil.css') }}">
<div class="imgcontainer">
    <div>
        <span class="text">
        AAA
        </span>
        <img class="img" id="img1" src="{{ asset('/img/1.jpeg') }}" > 
    </div>
    <div>
        <span class="text">
        AAA
        </span>
        <img class="img" src="{{ asset('/img/2.png') }}"> 
    </div>
    <br>
    <div>
        <img class="img" src="{{ asset('/img/3.jpg') }}"> 
    </div>
    <div>
        <img class="img" src="{{ asset('/img/4.png') }}"> 
    </div>
        

    
</div>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{ asset('/img/saut.jpg') }}" alt="premiere" height="auto">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('/img/saut.jpg') }}" alt="deuxieme" height="auto">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('/img/saut.jpg') }}" alt="troisieme" height="auto">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Précédent</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Suivant</span>
  </a>
</div>
@endsection
