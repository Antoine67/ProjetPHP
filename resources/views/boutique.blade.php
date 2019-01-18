@extends('layout')

@section('content')


<link rel="stylesheet" href="{{ asset('/css/boutique.css') }}">

<div id="globalNav" class="container-fluid text-center">
    <h2>
        Panier
    </h2>

    <p>Pour commencer à effectuer des achats,
        <br>
        veuillez vous
        <br>
        <a href="/connexion">connecter</a>
        ou
        <a href="/inscription">créer un compte</a>
    </p>

</div>
<div class="container-fluid text-center container">
    <hr>
    <h1>Notre boutique</h1>

        <div class="recherche_p">

            <form action="/search" id="searchthis" method="get">
                <input id="search" name="q" type="text" placeholder="Rechercher" />
                <input id="search-btn" type="submit" value="Rechercher" />
            </form>

        </div>
    <hr>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h2 id="best">Nos meilleures ventes: </h2>
        </div>
    <div class="row1">
        
        <a href="/idees">
            <div class="col-lg-4 col-md-6 col-sm-6 produit">
                <h2>Top objet 1</h2>
                <img id="topobjet1" src="{{ asset('/img/boutique/test.png') }}" alt="TopObjet1">
                <h2>Prix: 5€</h2>
            </div>
        </a>

        <a href="/idees">
            <div class="col-lg-4 col-md-6 col-sm-6 produit">
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
<div class="container-fluid text-center container"> 
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h2 id="best2">Tous nos produits: </h2>
    </div>
</div>


<div class="container-fluid text-center container">

    <div id="menu">

        <ul id="onglets">
            <div class = "gauche">
                <div class="dropdown"><a class="dropdown-toggle username" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fas fa-filter img3"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a href="#">Nom</a></li>
                        <li role="separator" class="divider"></li>
                        <li role="presentation"><a href="/deconnexion">Prix</a></li>
                        <li role="separator" class="divider"></li>
                        <li role="presentation"><a href="/deconnexion">Catégorie</a></li>
                    </ul>
                </div>
            </div>
            <li class="active"><a href=""> Matériels informatiques </a></li>
            <li class="active"><a href=""> Vêtements </a></li>
            <li class="active"><a href=""> Accessoirs </a></li>
            <li class="active"><a href=""> Autres </a></li>
        </ul>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class = "gauche">
            <a href="/idees">
                <i class="fas fa-plus-square"></i>
            </a>
        </div>
    </div>

    <div class="row1">

        <div class="col-lg-2 col-md-5 col-sm-4 ">
            <a href="/idees">
                <div class="produit">
                    <p>Objet 1</p>
                    <img id="objet1" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet1">
                    <p>Prix: 5€</p>
                </div>
            </a>
            <a href="/idees">
                <i class="fas fa-edit"></i>
            </a>
            <a href="/idees">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4 ">
            <a href="/idees">
                <div class="produit">
                    <p>Objet 2</p>
                    <img id="objet2" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet2">
                    <p>Prix: 5€</p>
                </div>
            </a>
            <a href="/idees">
                <i class="fas fa-edit"></i>
            </a>
            <a href="/idees">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4 ">
            <a href="/idees">
                <div class="produit">
                    <p>Objet 3</p>
                    <img id="objet3" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet3">
                    <p>Prix: 5€</p>
                </div>
            </a>
            <a href="/idees">
                <i class="fas fa-edit"></i>
            </a>
            <a href="/idees">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4 ">
            <a href="/idees">
                <div class="produit">
                    <p>Objet 4</p>
                    <img id="objet4" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet4">
                    <p>Prix: 5€</p>
                </div>
            </a>
            <a href="/idees">
                <i class="fas fa-edit"></i>
            </a>
            <a href="/idees">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4 ">
            <a href="/idees">
                <div class="produit">
                    <p>Objet 5</p>
                    <img id="objet5" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet5">
                    <p>Prix: 5€</p>
                </div>
            </a>
            <a href="/idees">
                <i class="fas fa-edit"></i>
            </a>
            <a href="/idees">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>

        <div class="col-lg-2 col-md-5 col-sm-4 ">
            <a href="/idees">
                <div class="produit">
                    <p>Objet 6</p>
                    <img id="objet6" class=" img2" src="{{ asset('/img/boutique/test.png') }}" alt="Objet6">
                    <p>Prix: 5€</p>
                </div>
            </a>
            <a href="/idees">
                <i class="fas fa-edit"></i>
            </a>
            <a href="/idees">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </div>
</div>



@endsection
