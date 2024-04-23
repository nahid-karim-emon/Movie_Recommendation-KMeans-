<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieCast extends Model
{
    use HasFactory;
    function cast()
    {
        return $this->belongsTo(Cast::class, 'cast_id');
    }
}
