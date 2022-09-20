<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay_message extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay_id',
        'message',
        'status',
    ];
}
