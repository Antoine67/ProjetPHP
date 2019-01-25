<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    public $timestamps = false;
    protected $fillable = ['Date_commande','Etat','Quantité','ID_Commandes', 'ID_Articles','ID_Utilisateurs','Prix_total'];
}
