<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieCountry extends Model
{
    use HasFactory;
    function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
