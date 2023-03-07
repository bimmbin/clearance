<?php

namespace App\Models;

use App\Models\Profiles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function profiles() {
        return $this->hasOne(Profiles::class);
    }

    public function clearance() {
        return $this->hasMany(Clearance::class);
    }
}
