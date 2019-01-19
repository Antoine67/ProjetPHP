<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    protected $fillable = ['ID','Denomination','Perm_boutique','Perm_idees','Perm_activites','Perm_header'];

    
}
