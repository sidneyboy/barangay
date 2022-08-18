<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assitance extends Model
{
    use HasFactory;

    protected $fillable = [
        'assistance_type_id',
        'resident_id',
        'barangay_id',
        'explanation',
        'status',
        'approved_cash',
        'approved_by_official_id',
        'approved_date'
    ];

    public function barangay()
    {
        return $this->belongsTo('App\Models\barangay', 'barangay_id');
    }

    public function resident()
    {
        return $this->belongsTo('App\Models\residents', 'resident_id');
    }

    public function assistance()
    {
        return $this->belongsTo('App\Models\assistance_type', 'assistance_type_id');
    }
}
