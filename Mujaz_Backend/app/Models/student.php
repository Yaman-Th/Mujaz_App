<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'teacher_id',
        'teacher_name',
        'phone',
        'starting_date'
    ];
}
