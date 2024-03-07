<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class session extends Model
{
    protected $fillable = [
        'date',
        'student_id',
        'student_name',
        'teacher_id',
        'teacher_name',
        'start_page',
        'end_page',
        'first_ayah',
        'last_ayah',
        'amount',
        'mark'

    ];
}
