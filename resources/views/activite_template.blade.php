@extends('layout')

@section('content')
<head>
<link rel="stylesheet" href="{{ asset('/css/activite.css') }}">

</head>

<div class="container text-center"> 

    <div class="row">
    <h1> Le nom de l'activité </h1>
    <hr class="hr2">
        <div>
        <a class="btn btn-default action-button butt" role="button" href="/inscription">Inscription à l'activité</a>
        <a class="btn btn-default action-button butt" role="button" href="/inscription">Ajouter des photos</a>
        <a class="btn btn-default action-button butt" role="button" href="/inscription">Liste des inscrits</a>

            <div>
                <h2><br>Football</h2>   
                <p>L'innovation. Voilà ce qui caractérise la Ford GT. Sa forme aérodynamique, ses renforts multifonction et son moteur V6 3,5 L EcoBoost® délivrant une puissance hors normes : tout dans la Ford GT est conçu pour la performance.
                L'innovation. Voilà ce qui caractérise la Ford GT. Sa forme aérodynamique, ses renforts multifonction et son moteur V6 3,5 L EcoBoost® délivrant une puissance hors normes : tout dans la Ford GT est conçu pour la performance.
                L'innovation. Voilà ce qui caractérise la Ford GT. Sa forme aérodynamique, ses renforts multifonction et son moteur V6 3,5 L EcoBoost® délivrant une puissance hors normes : tout dans la Ford GT est conçu pour la performance.
                L'innovation. Voilà ce qui caractérise la Ford GT. Sa forme aérodynamique, ses renforts multifonction et son moteur V6 3,5 L EcoBoost® délivrant une puissance hors normes : tout dans la Ford GT est conçu pour la performance.
                L'innovation. Voilà ce qui caractérise la Ford GT. Sa forme aérodynamique, ses renforts multifonction et son moteur V6 3,5 L EcoBoost® délivrant une puissance hors normes : tout dans la Ford GT est conçu pour la performance.
                L'innovation. Voilà ce qui caractérise la Ford GT. Sa forme aérodynamique, ses renforts multifonction et son moteur V6 3,5 L EcoBoost® délivrant une puissance hors normes : tout dans la Ford GT est conçu pour la performance. 
                </p>       
            </div>
            <div>
                <img class="vitrine" src="{{ asset('/img/foot.png') }}" alt="Image" >  
            </div>  

            <div>
                <div class="like">
                    <p id="like" class="texte">5 <i class="fas fa-thumbs-up upvote" role="button"></i></p> 
                    <Input placeholder="Ecrivez votre commentaire" class="commentaire" type="text" name="commentaire" size=30>
                </div>
                <label for="comment">Les commentaires :</label>

                <textarea readonly id="comment" name="comment">Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..Cette activité fut génial..
                </textarea>
            </div>
        </div>
    </div>
    
</div>
<script src="{{ asset('/js/activite.js') }}"></script>
@endsection