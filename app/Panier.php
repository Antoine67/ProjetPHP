<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    public $timestamps = false;
    protected $fillable = ['Quantité','Date_creation','ID_Utilisateurs','ID_Articles'];
}
