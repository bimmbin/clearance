<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentno',
        'firstname',
        'lastname',
        'middlename',
        'sex',
        'year',
        'course',
        'section',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
