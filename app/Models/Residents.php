<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residents extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_image',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'civil_status',
        'birth_date',
        'contact_number',
        'spouse',
        'mothers_name',
        'fathers_name',
        'email',
        'password',
        'barangay_id',
        'user_id',
        'zone',
        'voter',
        'permanent_address',
        'current_address',
    ];

    public function barangay()
    {
        return $this->belongsTo('App\Models\Barangay', 'barangay_id');
    }

    public function zone()
    {
        return $this->belongsTo('App\Models\Zone', 'zone');
    }

    public function barangay_official_id()
    {
        return $this->belongsTo('App\Models\Barangay_officials', 'user_id');
    }

}



