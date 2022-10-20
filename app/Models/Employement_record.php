<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employement_record extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'duration',
        'company',
        'address',
    ];
}
