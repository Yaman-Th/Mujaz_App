<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mistake extends Model
{
    protected $fillable = [
        'session_id',
        'type',
        'ayah_num',
        'word',
        'mark',
    ];
}
