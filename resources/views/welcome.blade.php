@extends('layout')

@section('content')
<!-- Metadata CSS/JS-->
<link rel="stylesheet" href="{{ asset('/css/accueil.css') }}">
<script src="{{ asset('/js/accueil.js') }}"></script>

<?php if(isset($_GET['inscription'])){
  echo '<div class="alert alert-success" style="margin-bottom:0px;" role="alert">Utilisateur créé avec succés! Vous pouvez à présent vous connecter 😃</div>' ;
} ?>






<!-- Carousel boostrap -->

<div class="container containerCaroussel">
  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Petits cercles indiquant quelle image est affichée -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Conteneur des slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img  class="carousselhover" alt="CarousselElement 1" src="{{ asset('/img/saut.jpg') }}" style="width:100%;">
        <div class="carousel-caption">
          <h3 class="textecaroussel">Donnez vos idées</h3>
          
        </div>
      </div>

      <div class="item">
        <img  class="carousselhover" alt="CarousselElement 2" src="{{ asset('/img/saut.jpg') }}" style="width:100%;">
        <div class="carousel-caption">
          <h3 class="textecaroussel">Visitez notre boutique</h3>
          
        </div>
      </div>
    
      <div class="item">
        <img  class="carousselhover" alt="CarousselElement 3" src="{{ asset('/img/saut.jpg') }}" style="width:100%;">
        <div class="carousel-caption">
          <h3 class="textecaroussel">Venez vous amuser en vous inscrivant à nos activités</h3>
          
        </div>
      </div>
  
    </div>

    <!-- Flèches droite gauche -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>






<!-- Photos accueil du site -->
<div class="imgcontainer">
  <div class="bandefond">
    <div class="imagetexte">
      <img class="img" alt="Article 1" src="{{ asset('/img/badminton.png') }}" > 
      <div class="text">
        AAA
      </div>
    </div>
    <div class="imagetexte">
      <img class="img" alt="Article 2" src="{{ asset('/img/foot.png') }}"> 
      <div class="text">
        WWWWWWW
      </div>
    </div>
    
    <div  class="imagetexte">
      <img class="img" alt="Article 3" src="{{ asset('/img/saut.jpg') }}"> 
      <div class="text">
        WWWWWWW
      </div>
    </div>
  </div>
    <br>
  <div class="bandefond">
    <div  class="imagetexte" >
      <img class="img" alt="Article4" src="{{ asset('/img/images.jpeg') }}"> 
      <div class="text">
        WWWWWWW
      </div>
    </div>
    
    <div  class="imagetexte">
      <img class="img" alt="Article 5" src="{{ asset('/img/3.jpg') }}"> 
        <div class="text">
          WWWWWWW
        </div>
    </div>
    
    <div  class="imagetexte">
      <img class="img" alt="Article 6" src="{{ asset('/img/3.jpg') }}"> 
      <div class="text">
         WWWWWWW
      </div>
    </div>
  </div>  
</div>







<script src="{{ asset('/js/accueil.js') }}"></script>




@endsection
