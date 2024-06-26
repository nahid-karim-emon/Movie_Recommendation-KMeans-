<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionCompany extends Model
{
    use HasFactory;
    function pcompany()
    {
        return $this->belongsTo(ProductionCompany::class, 'pcompany_id');
    }

    function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }
}
