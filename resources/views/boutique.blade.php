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
    <div class="row1">
        <div class="col-lg-4 col-md-5 col-sm-6">
            <h2><br>Top objet 1</h2>
            <br>
            <img id="objet1" src="{{ asset('/img/boutique/test.png') }}" alt="Objet1">
        </div>

        <div class="col-lg-4 col-md-5 col-sm-6">
            <h2><br>Top objet 2</h2>
            <br>
            <img id="objet2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet2">
        </div>

        <div class="col-lg-4 col-md-5 col-sm-6">
            <h2> <br>Top objet 3</h2>
            <br>
            <img id="objet3" src="{{ asset('/img/boutique/test.png') }}" alt="Objet3">

    </div>
</div>
<div class="container-fluid text-center"> 
    <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-6 img2">
            <h2><br>Top objet 1</h2>
            <br>
            <img id="objet1" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet1">
        </div>

        <div class="col-lg-4 col-md-5 col-sm-6 img2">
            <h2><br>Top objet 2</h2>
            <br>
            <img id="objet2" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet2">
        </div>

        <div class="col-lg-4 col-md-5 col-sm-6 img2">
            <h2> <br>Top objet 3</h2>
            <br>
            <img id="objet3" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet3">
    </div>
</div>
@endsection
