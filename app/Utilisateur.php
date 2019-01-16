<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $fillable = array('identifiant', 'password');
}
