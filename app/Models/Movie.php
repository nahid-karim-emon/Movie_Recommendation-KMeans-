<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    function MovieGenre()
    {
        return $this->hasMany(MovieGenre::class, 'movie_id');
    }
    function MovieCountry()
    {
        return $this->hasMany(MovieCountry::class, 'movie_id');
    }
    function MovieCast()
    {
        return $this->hasMany(MovieCast::class, 'movie_id');
    }
    function MovieLanguage()
    {
        return $this->hasMany(MovieLanguage::class, 'movie_id');
    }
    function MoviePcompany()
    {
        return $this->hasMany(MoviePcompany::class, 'movie_id');
    }
    function MovieDirector()
    {
        return $this->hasMany(MovieDirector::class, 'movie_id');
    }
    function MovieRating()
    {
        return $this->hasMany(MovieRating::class, 'movie_id');
    }
}
