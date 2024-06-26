<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieLanguage extends Model
{
    use HasFactory;
    function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
    function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
