<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['patient_id', 'amount', 'status', 'billing_date'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}

