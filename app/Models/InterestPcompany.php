<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestPcompany extends Model
{
    use HasFactory;
    function pcompany()
    {
        return $this->belongsTo(ProductionCompany::class, 'pcompany_id');
    }
}
