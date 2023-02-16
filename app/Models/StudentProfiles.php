<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfiles extends Model
{
    use HasFactory;

    protected $table = 'student_profiles';

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
    
}
