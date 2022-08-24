<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay_logo extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay_id',
        'user_id',
        'logo',
    ];
}
