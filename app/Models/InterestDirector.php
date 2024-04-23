<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestDirector extends Model
{
    use HasFactory;
    function director()
    {
        return $this->belongsTo(Director::class, 'director_id');
    }
}
