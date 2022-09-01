<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document_request extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'user_id',
        'document_type_id',
        'barangay_id',
        'status',
        'time_approved',
        'time_disapproved',
        'time_received',
        'reason',
    ];

    public function staff()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function resident()
    {
        return $this->belongsTo('App\Models\Residents', 'resident_id');
    }

    public function document()
    {
        return $this->belongsTo('App\Models\Document_type', 'document_type_id');
    }
}
