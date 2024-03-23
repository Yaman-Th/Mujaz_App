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
        'pages',
        'ayat',
        'amount',
        'mistakes',
        'taps_num',
        'mark',
        'duration',
        'notes'
    ];

    protected $casts = [
        'pages' => 'array',
        'ayat' => 'array',
        'mistakes' => 'array'
    ];
}
