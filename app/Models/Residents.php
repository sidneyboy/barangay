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
        'status',
        'present_house_block',
        'present_subd',
        'present_municipality',
        'present_province',
        'present_living_status',
        'present_length_of_stay',
        'provincial_house_block',
        'provincial_subd',
        'provincial_municipality',
        'provincial_province',
        'weight',
        'height',
    ];

    public function barangay()
    {
        return $this->belongsTo('App\Models\Barangay', 'barangay_id');
    }

    public function res_zone()
    {
        return $this->belongsTo('App\Models\Zone', 'zone');
    }

    public function barangay_official_id()
    {
        return $this->belongsTo('App\Models\Barangay_officials', 'user_id');
    }

    public function resident_education()
    {
        return $this->hasMany('App\Models\Resident_education', 'resident_id');
    }

    public function resident_employment()
    {
        return $this->hasMany('App\Models\Employement_record', 'resident_id');
    }

    public function resident_household()
    {
        return $this->hasMany('App\Models\Resident_households', 'resident_id');
    }
}
