<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'department_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }
}
