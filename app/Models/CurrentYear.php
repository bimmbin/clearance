<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_year_id',
    ];

    public function schoolyear() {
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }
}
