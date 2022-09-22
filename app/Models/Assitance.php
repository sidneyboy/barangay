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
        'approved_date',
        'image',
        'reason',
        'assistance_number',
    ];

    public function barangay()
    {
        return $this->belongsTo('App\Models\Barangay', 'barangay_id');
    }

    public function resident()
    {
        return $this->belongsTo('App\Models\Residents', 'resident_id');
    }

    public function assistance()
    {
        return $this->belongsTo('App\Models\Assistance_type', 'assistance_type_id');
    }
}
