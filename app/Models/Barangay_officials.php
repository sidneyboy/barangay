<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay_officials extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_image',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'civil_status',
        'position_type_id',
        'birth_date',
        'office_term',
        'contact_number',
        'spouse',
        'email',
        'password',
        'barangay_id',
    ];

    public function barangay()
    {
        return $this->belongsTo('App\Models\Barangay', 'barangay_id');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\Barangay_position', 'position_type_id');
    }
}
