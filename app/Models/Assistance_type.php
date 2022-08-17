<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistance_type extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'barangay_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\barangay_officials', 'user_id');
    }
}
