<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $timestamps = false;
    protected $fillable = ['Positif','ID_Utilisateurs','ID_Image_activites'];
}
