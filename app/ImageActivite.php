<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageActivite extends Model
{
    public $timestamps = false;
    protected $fillable = ['Image','Auteur','Valide', 'ID_Activites','ID_Utilisateurs'];
}
