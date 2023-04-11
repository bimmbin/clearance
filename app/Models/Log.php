<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'clearance_id',
        'details',

    ];
    
    public function profiles() {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }
    public function clearance() {
        return $this->belongsTo(Clearance::class);
    }
}
