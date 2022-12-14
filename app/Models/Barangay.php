<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = [
        'region',
        'province',
        'city',
        'barangay',
        'latitude',
        'longitude',
        'status',
        'provCode',
        'citymunCode',
        'regCode',
        'brgyCode',
    ];
}
