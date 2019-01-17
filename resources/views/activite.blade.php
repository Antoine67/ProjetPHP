@extends('layout')

@section('content')
<head>
<link rel="stylesheet" href="{{ asset('/css/activite.css') }}">

</head>
<div class="container-fluid text-center"> 
      <h1> Nos activités </h1>
      <hr class="hr2">
      <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-6">
            <div class="divv">
                <h2><br>Accrobranche</h2>
                    <p>Vos collègues, votre famille, vos amis... Le nouveau Ranger vous offre l'espace qu'il vous faut parmi trois styles de cabines et quatre modèles. 
                    Toujours aussi spacieux et mieux équipé que jamais, vous et vos passagers profiterez d'un véritable espace de confort et d'élégance. 
                    </p>  
            </div>
            
            <div>
                <img src="{{ asset('/img/images.jpeg') }}" alt="Image">
            </div> 
        </div>

        <div class="col-lg-4 col-md-5 col-sm-6">
            <div class="divv">
                <h2><br>Football</h2>
                    <p>L'innovation. Voilà ce qui caractérise la Ford GT. Sa forme aérodynamique, ses renforts multifonction et son moteur V6 3,5 L EcoBoost® délivrant une puissance hors normes : tout dans la Ford GT est conçu pour la performance. 
                    </p>          
            </div>
            <div>
                <img src="{{ asset('/img/foot.png') }}" alt="Image" >     
            </div>  
        </div>

        <div class="col-lg-4 col-md-5 col-sm-6">
            <div class="divv">
                <h2> <br>Badminton</h2>
                <p>Un nouveau design associant agressivité et efficacité aérodynamique.
                            Des performances inégalées avec la suspension adaptative pilotée MagneRide™; un plaisir de conduite incomparable grâce au nouvel échappement actif, sublimant les vocalises du mythique V8 
                </p>
            </div>
            <div>
                <img src="{{ asset('/img/badminton.png') }}" alt="Image">
            </div> 
        </div>


            




</div>
@endsection