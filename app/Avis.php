<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    public $timestamps = false;
    protected $fillable = ['Contenu','Date_creation','ID_Utilisateurs','ID_Activites'];

    
}
