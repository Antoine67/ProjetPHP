@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/acceuil.css') }}">
<title>Accueil - BDE</title>
<div class="imgcontainer">
  <div class="bandefond">
    <div class="imagetexte">
    <img class="img" alt="Article 1" src="{{ asset('/img/badminton.png') }}" > 
      <div class="text">
        AAA
      </div>
    </div>
    <div class="imagetexte">
    <img class="img" src="{{ asset('/img/foot.png') }}"> 
      <div class="text">
        WWWWWWW
      </div>
    </div>
    
    <div  class="imagetexte">
    <img class="img" src="{{ asset('/img/saut.jpg') }}"> 
        <div class="text">
          WWWWWWW
        </div>
    </div>
  </div>
    <br>
  <div class="bandefond">
    <div  class="imagetexte" >
        <img class="img" src="{{ asset('/img/images.jpeg') }}"> 
        <div class="text">
          WWWWWWW
        </div>
    </div>
    
    <div  class="imagetexte">
    <img class="img" src="{{ asset('/img/3.jpg') }}"> 
        <div class="text">
          WWWWWWW
        </div>
    </div>
    
    <div  class="imagetexte">
    <img class="img" src="{{ asset('/img/3.jpg') }}"> 
        <div class="text">
          WWWWWWW
        </div>
    </div>
  </div>

    
</div>










<div class="container">
  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img  class="carousselhover" src="{{ asset('/img/saut.jpg') }}" alt="Los Angeles" style="width:100%;">
        <div class="carousel-caption">
          <h3 class="textecaroussel">Donnez vos idées</h3>
          
        </div>
      </div>

      <div class="item">
        <img  class="carousselhover" src="{{ asset('/img/saut.jpg') }}" alt="Chicago" style="width:100%;">
        <div class="carousel-caption">
          <h3 class="textecaroussel">Visitez notre boutique</h3>
          
        </div>
      </div>
    
      <div class="item">
        <img  class="carousselhover" src="{{ asset('/img/saut.jpg') }}" alt="New York" style="width:100%;">
        <div class="carousel-caption">
          <h3 class="textecaroussel">Venez vous amuser en vous inscrivant à nos activités</h3>
          
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
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





@endsection
