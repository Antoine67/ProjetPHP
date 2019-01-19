@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/activite_specifique.css') }}">


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
                    
                </div>

                <div class="commentaire">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Bada</strong> <span class="text-muted">il y a 5 jours</span>
                        </div>

                        <div class="panel-body">
                            C'est vraiment trop bien le foot wtf
                        </div><!-- /panel-body -->
                    </div><!-- /panel panel-default -->
                </div><!-- /col-sm-5 -->

                <div class="commentaire">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>Pique</strong> <span class="text-muted">il y a 2 jours</span>
                        </div>

                        <div class="panel-body">
                            Wow
                        </div><!-- /panel-body -->
                    </div><!-- /panel panel-default -->
                </div><!-- /col-sm-5 -->
                <hr/>
                <form>
                    <div class="form-group">
                        <label for="votre-commentaire">Vous avez participé à cette activité ? <br/>Partager votre avis sur cette activité :</label>
                        <textarea class="form-control" style="resize: none;" rows="5" placeholder="Ecrire un commentaire..." id="votre-commentaire"></textarea>
                    </div>
                    <div class="right"><button type="submit" class="btn btn-success submit-commentaire">Envoyer</button></div>
                </form>
                
            </div>
        </div>
    </div>
    
</div>
<script src="{{ asset('/js/activite.js') }}"></script>
@endsection