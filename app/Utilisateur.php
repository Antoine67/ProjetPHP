<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    public $timestamps = false;

    protected $fillable = array('nom','prenom','motdepasse', 'email','localisation','role');
}
