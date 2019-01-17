@extends('layout')

@section('content')
<head>

    <link rel="stylesheet" href="{{ asset('/css/boutique.css') }}">

</head>
<div class="container-fluid text-center">
    <hr color="darkgrey">
    <h1> Notre boutique</h1>

        <div class="recherche_p">

            <form action="/search" id="searchthis" method="get">
                <input id="search" name="q" type="text" placeholder="Rechercher" />
                <input id="search-btn" type="submit" value="Rechercher" />
            </form>

        </div>
    <hr color="darkgrey">
        <div class="col-lg-12 col-md-5 col-sm-12">
            <h2 id="best">Nos meilleures ventes: </h2>
        </div>
    <div class="row1">
        
        <a href="/idees">
            <div class="col-lg-4 col-md-5 col-sm-6 produit">
                <h2>Top objet 1</h2>
                <img id="topobjet1" src="{{ asset('/img/boutique/test.png') }}" alt="TopObjet1">
                <h2>Prix: 5€</h2>
            </div>
        </a>

        <a href="/idees">
            <div class="col-lg-4 col-md-5 col-sm-6 produit">
                <h2>Top objet 2</h2>
                <img id="topobjet2" src="{{ asset('/img/boutique/test.png') }}" alt="TopObjet2">
                <h2>Prix: 5€</h2>
            </div>
        </a>

        <a href="/idees">
            <div class="col-lg-4 col-md-12 col-sm-12 produit">
                <h2>Top objet 3</h2>
                <img id="topobjet3" src="{{ asset('/img/boutique/test.png') }}" alt="TopObjet3">
                <h2>Prix: 5€</h2>
            </div>
        </a>

    </div>
</div>
    <div class="col-lg-12 col-md-5 col-sm-12">
        <h2 id="best">Tous nos produits: </h2>
    </div>
<div class="container-fluid text-center"> 
    <div class="row1">

        <a href="/idees">
            <div class="col-lg-2 col-md-5 col-sm-4 produit">
                <h2>Objet 1</h2>
                <img id="objet1" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet1">
                <h2>Prix: 5€</h2>
            </div>
        </a>

        <a href="/idees">
            <div class="col-lg-2 col-md-5 col-sm-4 produit">
                <h2>Objet 2</h2>
                <img id="objet2" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet2">
                <h2>Prix: 5€</h2>
            </div>
        </a>

        <a href="/idees">
            <div class="col-lg-2 col-md-5 col-sm-4 produit">
                <h2>Objet 3</h2>
                <img id="objet3" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet3">
                <h2>Prix: 5€</h2>
            </div>
        </a>

        <a href="/idees">
            <div class="col-lg-2 col-md-5 col-sm-4 produit">
                <h2>Objet 4</h2>
                <img id="objet4" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet4">
                <h2>Prix: 5€</h2>
            </div>
        </a>

        <a href="/idees">
            <div class="col-lg-2 col-md-5 col-sm-4 produit">
                <h2>Objet 5</h2>
                <img id="objet5" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet5">
                <h2>Prix: 5€</h2>
            </div>
        </a>

        <a href="/idees">
            <div class="col-lg-2 col-md-5 col-sm-4 produit">
                <h2>Objet 6</h2>
                <img id="objet6" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet6">
                <h2>Prix: 5€</h2>
            </div>
        </a>
    </div>
</div>
@endsection
