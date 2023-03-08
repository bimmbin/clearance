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
        'status'
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }
    public function profiles() {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }
}
