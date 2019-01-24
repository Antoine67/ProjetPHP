<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentaireImage extends Model
{
    public $timestamps = false;
    protected $fillable = ['Contenu', 'ID_Image_Activites','ID_Utilisateurs'];
}
