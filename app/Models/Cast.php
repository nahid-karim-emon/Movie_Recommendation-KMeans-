<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;
    public static function countMale()
    {
        return self::where('gender', '=', 'male')->count();
    }
    public static function countFemale()
    {
        return self::where('gender', '=', 'female')->count();
    }
}
