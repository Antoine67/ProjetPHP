<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    public $timestamps = false;
    protected $fillable = ['Date_inscription','ID_Utilisateurs','ID_Activites'];
}
