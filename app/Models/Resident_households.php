<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident_households extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'name',
        'position',
        'age',
        'birth_date',
        'civil_status',
        'occupation',
    ];
}
