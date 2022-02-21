<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class genre extends Model
{

    protected $fillable = ['e_id', 'name'];

    //attr
    //scope

    //rel
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_genre');
    } // end of movies


}