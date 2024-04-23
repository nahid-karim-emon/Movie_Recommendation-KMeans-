<?php

namespace App\Models;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email','subject', 'message','objective','staff_id'];
    function Staff(){
        return $this->belongsTo(Staff::class,'staff_id');
    }
}
