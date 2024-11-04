<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'dob',
        'gender',
        'address',
        'phone',
        'medical_history',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
