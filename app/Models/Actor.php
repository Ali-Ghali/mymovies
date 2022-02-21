<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = ['e_id', 'name', 'image'];

    protected $appends = ['image_path'];

    //attr
    public function getImagePathAttribute()
    {
        return 'https://image.tmdb.org/t/p/w500' . $this->image;
    } // end of getImagePathAttribute

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_actor');
    } // end of actors

}