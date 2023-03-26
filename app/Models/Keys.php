<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keys extends Model
{
    protected $fillable = [
        'user_id',
        'public_key',
        'private_key',
    ];

    use HasFactory;
}
