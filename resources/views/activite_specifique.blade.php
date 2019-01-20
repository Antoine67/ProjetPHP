@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/activite_specifique.css') }}">


<div class="container text-center"> 

    <div class="row">
    <h1> Football </h1>
    <hr class="hr2">
        <div>
        <a class="btn btn-default action-button butt" role="button" href="/inscription">S'inscire à l'activité</a>
        <a class="btn btn-default action-button butt" role="button" href="/inscription">Liste des inscrits</a>
        <a class="btn btn-default action-button butt" role="button" data-toggle="modal" data-target="#ajouter-photo">Ajouter des photos</a>

        <!-- Mini-fenêtre (modal) -->
        <div class="modal fade" id="ajouter-photo" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title" id="titre-modal">Ajouter des photos</h3>

                    </div>

                    <!-- Panel pour ajouter des photos -->
                    <div class="modal-body basket-content">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            Selectionnez l'image que vous souhaitez ajouter à cette activité :
                            <input type="file" class="btn btn-primary" name="file">
                            <div class="right"><button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Ajouter</button></div>
                        </form>           
                    </div>

                </div>
            </div>
        </div>













            <div>
                <h2><br>Description de l'activité :</h2>   
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