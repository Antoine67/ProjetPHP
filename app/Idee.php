<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idee extends Model
{
    public $timestamps = false;
    protected $fillable = ['Titre','Contenu','Date_creation','Etat','ID_Utilisateurs'];
}
