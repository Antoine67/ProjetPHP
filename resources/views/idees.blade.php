@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/idees.css') }}">
<script src="{{ asset('/js/idee.js') }}"></script>

<div class="container-fluid container"> 
  <h1> La boîte à idées </h1>
  <hr/>
</div>
<div class="container-fluid container"> 
    <div class="col-lg-12 col-md-12 col-sm-12 categories">

        <h2 class = "titre">Idées proposées</h2>
        <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
            <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                <img class="img" src="{{ asset('/img/1.jpeg') }}" >
            </div>

            <div class="col-lg-10 col-md-10 col-sm-10 idee">
                <p class="left">- Vos collègues, votre famille, vos amis... Le nouveau Ranger vous offre l'espace qu'il vous faut parmi trois styles de cabines et quatre modèles. 
                Toujours aussi spacieux et mieux équipé que jamais, vous et vos passagers profiterez d'un véritable espace de confort et d'élégance. 
                </p>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 upvote">
                <a class="btn btn-default upvote-button" role="button" data-toggle="modal" data-target="#upvote-idee"><i class="fas fa-angle-up"> 1000</i> </a>
                <a class="btn btn-default check-button" role="button" data-toggle="modal" data-target="#check-idee"><i class="fas fa-check"></i></a>
                <a class="btn btn-default ban-button" role="button" data-toggle="modal" data-target="#ban-idee"><i class="fas fa-ban"></i></a>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
            <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                <img class="img" src="{{ asset('/img/1.jpeg') }}" >
            </div>

            <div class="col-lg-10 col-md-10 col-sm-10 idee">
                <p class="left">- Vos collègues, votre famille, vos amis... Le nouveau Ranger vous offre l'espace qu'il vous faut parmi trois styles de cabines et quatre modèles. 
                Toujours aussi spacieux et mieux équipé que jamais, vous et vos passagers profiterez d'un véritable espace de confort et d'élégance. 
                </p>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 upvote">
                <a class="btn btn-default upvote-button" role="button" data-toggle="modal" data-target="#upvote-idee"><i class="fas fa-angle-up"> 1000</i></a>
                <a class="btn btn-default check-button" role="button" data-toggle="modal" data-target="#check-idee"><i class="fas fa-check"></i></a>
                <a class="btn btn-default ban-button" role="button" data-toggle="modal" data-target="#ban-idee"><i class="fas fa-ban"></i></a>
            </div>
        </div>
    </div>

    <div>
        <div>
            <label class="left">Vous pensez avoir une bonne idée ? <br/>Partagez la !</label>
            <textarea name="commentaire" class="form-control" style="resize: none;" rows="5" placeholder="Ecrire une idée..." id="votre-idée"></textarea>
        </div>
        <div class="right"><button type="submit" class="btn btn-success submit-commentaire envoyer">Envoyer</button></div>
    </div>
    
    <div class="col-lg-12 col-md-12 col-sm-12 categories">
        <h2 class = "titre">Idées acceptées</h2>
        <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
            <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                <img class="img" src="{{ asset('/img/1.jpeg') }}" >
            </div>

            <div class="col-lg-10 col-md-10 col-sm-10 idee">
                <p class="left">- Vos collègues, votre famille, vos amis... Le nouveau Ranger vous offre l'espace qu'il vous faut parmi trois styles de cabines et quatre modèles. 
                Toujours aussi spacieux et mieux équipé que jamais, vous et vos passagers profiterez d'un véritable espace de confort et d'élégance. 
                </p>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
            <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                <img class="img" src="{{ asset('/img/1.jpeg') }}" >
            </div>

            <div class="col-lg-10 col-md-10 col-sm-10 idee">
                <p class="left">- Vos collègues, votre famille, vos amis... Le nouveau Ranger vous offre l'espace qu'il vous faut parmi trois styles de cabines et quatre modèles. 
                Toujours aussi spacieux et mieux équipé que jamais, vous et vos passagers profiterez d'un véritable espace de confort et d'élégance. 
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 categories">
        <h2 class = "titre">Idées refusées</h2>
        <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
            <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                <img class="img" src="{{ asset('/img/1.jpeg') }}" >
            </div>

            <div class="col-lg-10 col-md-10 col-sm-10 idee">
                <p class="left">- Vos collègues, votre famille, vos amis... Le nouveau Ranger vous offre l'espace qu'il vous faut parmi trois styles de cabines et quatre modèles. 
                Toujours aussi spacieux et mieux équipé que jamais, vous et vos passagers profiterez d'un véritable espace de confort et d'élégance. 
                </p>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 diffidee">
            <div class="col-lg-10 col-md-10 col-sm-10 div-img">
                <img class="img" src="{{ asset('/img/1.jpeg') }}" >
            </div>

            <div class="col-lg-10 col-md-10 col-sm-10 idee">
                <p class="left">- Vos collègues, votre famille, vos amis... Le nouveau Ranger vous offre l'espace qu'il vous faut parmi trois styles de cabines et quatre modèles. 
                Toujours aussi spacieux et mieux équipé que jamais, vous et vos passagers profiterez d'un véritable espace de confort et d'élégance. 
                </p>
            </div>
        </div>
    </div>

</div> 

@endsection