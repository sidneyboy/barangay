<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay_position extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'barangay_id',
    ];

    public function barangay()
    {
        return $this->belongsTo('App\Models\Barangay', 'barangay_id');
    }
}
