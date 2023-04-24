<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
    ];

    public function clearance() {
        return $this->hasOne(Clearance::class, 'school_year_id');
    }
    public function currentyear() {
        return $this->hasOne(CurrentYear::class, 'school_year_id');
    }
    public function user() {
        return $this->hasMany(User::class);
    }
}
