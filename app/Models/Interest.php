<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;
    function InterestGenre()
    {
        return $this->hasMany(InterestGenre::class, 'interest_id');
    }
    function InterestCountry()
    {
        return $this->hasMany(InterestCountry::class, 'interest_id');
    }
    function InterestCast()
    {
        return $this->hasMany(InterestCast::class, 'interest_id');
    }
    function InterestLanguage()
    {
        return $this->hasMany(InterestLanguage::class, 'interest_id');
    }
    function InterestPcompany()
    {
        return $this->hasMany(InterestPcompany::class, 'interest_id');
    }
    function InterestDirector()
    {
        return $this->hasMany(InterestDirector::class, 'interest_id');
    }
    function InterestRating()
    {
        return $this->hasMany(InterestRating::class, 'interest_id');
    }
}
