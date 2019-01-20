<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    public $timestamps = false;
    protected $dateFormat = "Y-m-d H:i:s";
    protected $fillable = ['Contenu','Date_creation','ID_Utilisateurs','ID_Activites'];

    protected $casts = [
        'Date_creation' => 'date:hh:mm'
    ];
}
