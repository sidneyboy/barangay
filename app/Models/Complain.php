<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;

    protected $fillable = [
        'complainant_id',
        'respondent_id',
        'reason',
        'lupon_id',
        'hearing_date',
        'image',
        'status',
        'barangay_id',
        'time',
        'time_started',
        'time_ended',
    ];

    public function barangay()
    {
        return $this->belongsTo('App\Models\Barangay', 'barangay_id');
    }

    public function complainant()
    {
        return $this->belongsTo('App\Models\Residents', 'complainant_id');
    }

    public function respondent()
    {
        return $this->belongsTo('App\Models\Residents', 'respondent_id');
    }

    public function lupon()
    {
        return $this->belongsTo('App\Models\Barangay_officials', 'lupon_id');
    }
}
