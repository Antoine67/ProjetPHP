<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    public $timestamps = false;
    protected $fillable = ['Titre','Prix','Image','Description','Date_realisation','Date_creation','ID_Utilisateurs'];
}
