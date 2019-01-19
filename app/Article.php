<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $timestamps = false;
    protected $fillable = ['Nom','Description','Prix','Stock','Image','Vendu','Categorie'];
}
