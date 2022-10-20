<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident_education extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'level_of_education',
        'school',
        'address',
    ];
}


