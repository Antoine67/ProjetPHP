@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/activite.css') }}">


<div class="container text-center"> 

    <div class="row">
    <h1> Prochaine activité </h1>
    <hr class="hr2">
        <a href="/activiste">
            <div>
                <div class="suivante">
                    <h2><br>Football</h2>          
                </div>
                <div>
                    <img class="vitrine" src="{{ asset('/img/foot.png') }}" alt="Image" >     
                </div>  
            </div>
        </a>
    </div>


    <div class="row">
        <h1> Activités à venir </h1>
        <hr class="hr2">
        <a href="/activiste">
            <div class="col-lg-4 col-md-5 col-sm-6">
 
                <div class="divv">
                    <h2><br>Accrobranche</h2>
                        <p>Vos collègues, votre famille, vos amis... Le nouveau Ranger vous offre l'espace qu'il vous faut parmi trois styles de cabines et quatre modèles. 
                        Toujours aussi spacieux et mieux équipé que jamais, vous et vos passagers profiterez d'un véritable espace de confort et d'élégance. 
                        </p>  
                </div>
                
                
                <div>
                    <img src="{{ asset('/img/images.jpeg') }}"  alt="Image">
                </div> 
                
            </div>
        </a>
        <a href="/activiste">
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
        </a>
        <a href="/activiste">
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
        </a>
    </div>

    <div class="row">
        <h1> Activités passées </h1>
        <hr class="hr2">
        <a href="/activiste">
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
        </a>
        <a href="/activiste">
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
        </a>
        <a href="/activiste">
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
        </a>
    </div>
    
</div>
@endsection