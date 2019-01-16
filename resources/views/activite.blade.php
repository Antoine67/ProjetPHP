@extends('layout')

@section('content')
<head>
<link rel="stylesheet" href="{{ asset('/css/activite.css') }}">

</head>
<div class="container-fluid text-center"> 
         <div class="container-fluid text-center"> 
      <h1> Nos activités </h1>
      <hr color="darkgrey">
      <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-6">
              <h2><br>Ford RANGER</h2>
                     <p>Vos collègues, votre famille, vos amis... Le nouveau Ranger vous offre l'espace qu'il vous faut parmi trois styles de cabines et quatre modèles. 
Toujours aussi spacieux et mieux équipé que jamais, vous et vos passagers profiterez d'un véritable espace de confort et d'élégance. </p>  
                    <img id="badminton" src="{{ asset('/img/images.jpeg') }}" alt="Badminton" >
                    <img id="footbal" src="{{ asset('/img/Football-les-32-qualifies-pour-la-Coupe-du-monde-et-les-chapeaux-definitifs.jpg') }}" alt="Foot">
                    <img id="accrobranche" src="{{ asset('/img/badminton.jpg') }}" alt="Accrobranche">
        </div>

          <div class="col-lg-4 col-md-5 col-sm-6">
                  <h2><br>Ford GT</h2>
                     <p>L'innovation. Voilà ce qui caractérise la Ford GT. Sa forme aérodynamique, ses renforts multifonction et son moteur V6 3,5 L EcoBoost® délivrant une puissance hors normes : tout dans la Ford GT est conçu pour la performance. </p> <br> <br> 
                     <img id="ford gt" class="img-responsive" src="f:/ford gt.jpg" width="100% \9"  alt="Ford GT"> 
          </div>
          <div class="col-lg-4 col-md-5 col-sm-6">
                    <h2> <br>Ford MUSTANG GT</h2>
                     <p>Un nouveau design associant agressivité et efficacité aérodynamique.
Des performances inégalées avec la suspension adaptative pilotée MagneRide™; un plaisir de conduite incomparable grâce au nouvel échappement actif, sublimant les vocalises du mythique V8 </p> <br>
          <img id="mustang gt" class="img-responsive" src="f:/mustang gt 2.jpeg" width="100% \9" alt="Mustang">

          </div>
    </div>
@endsection