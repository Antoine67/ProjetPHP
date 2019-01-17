@extends('layout')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('/css/idees.css') }}">
</head>

<div class="container-fluid text-center"> 
  <h1> La boîte à idées </h1>
  <hr class="hr2">
  <div class="row">

        <div class="col-lg-4 col-md-5 col-sm-6">
            <div class="divv">
                <h2>Idées proposées</h2>
                    <p>Vos collègues, votre famille, vos amis... Le nouveau Ranger vous offre l'espace qu'il vous faut parmi trois styles de cabines et quatre modèles. 
                    Toujours aussi spacieux et mieux équipé que jamais, vous et vos passagers profiterez d'un véritable espace de confort et d'élégance. 
                    </p>  
            </div>
            
        </div>

    </div>
</div>
@endsection