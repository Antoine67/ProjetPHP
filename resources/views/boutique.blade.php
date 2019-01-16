@extends('layout')

@section('content')
<head>

    <link rel="stylesheet" href="{{ asset('/css/boutique.css') }}">

</head>
<div class="container-fluid text-center"> 
    <h1> Notre boutique </h1>
    <hr color="darkgrey">
        <div class="recherche_p">

            <form action="/search" id="searchthis" method="get">
                <input id="search" name="q" type="text" placeholder="Rechercher" />
                <input id="search-btn" type="submit" value="Rechercher" />
            </form>

        </div>
    <hr color="darkgrey">

    <div class="row1">
        <div class="col-lg-4 col-md-5 col-sm-6">
            <h2><br>Top objet 1</h2>
            <br>
            <img id="topobjet1" src="{{ asset('/img/boutique/test.png') }}" alt="TopObjet1">
            <h2><br>Prix: 5€</h2>
        </div>

        <div class="col-lg-4 col-md-5 col-sm-6">
            <h2><br>Top objet 2</h2>
            <br>
            <img id="topobjet2" src="{{ asset('/img/boutique/test.png') }}" alt="TopObjet2">
            <h2><br>Prix: 5€</h2>
        </div>

        <div class="col-lg-4 col-md-12 col-sm-12">
            <h2> <br>Top objet 3</h2>
            <br>
            <img id="topobjet3" src="{{ asset('/img/boutique/test.png') }}" alt="TopObjet3">
            <h2><br>Prix: 5€</h2>
        </div>

    </div>
</div>
<div class="container-fluid text-center"> 
    <div class="row">
        <div class="col-lg-2 col-md-5 col-sm-4">
            <h2><br>Objet 1</h2>
            <br>
            <img id="objet1" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet1">
            <h2><br>Prix: 5€</h2>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4">
            <h2><br>Objet 2</h2>
            <br>
            <img id="objet2" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet2">
            <h2><br>Prix: 5€</h2>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4">
            <h2> <br>Objet 3</h2>
            <br>
            <img id="objet3" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet3">
            <h2><br>Prix: 5€</h2>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4">
            <h2><br>Objet 4</h2>
            <br>
            <img id="objet4" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet4">
            <h2><br>Prix: 5€</h2>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4">
            <h2><br>Objet 5</h2>
            <br>
            <img id="objet5" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet5">
            <h2><br>Prix: 5€</h2>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4">
            <h2> <br>Objet 6</h2>
            <br>
            <img id="objet6" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet6">
            <h2><br>Prix: 5€</h2>
        </div>
    </div>
</div>
@endsection
