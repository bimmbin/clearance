<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'profile_id',
        'signature',
        'school_year_id',
        'remarks',
        'status',
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }
    public function profiles() {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }
    public function schoolyear() {
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }

}
