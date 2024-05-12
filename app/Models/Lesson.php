<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lesson';

    protected $fillable = [
        'id',
        'name',
        'video_path',
        'description',
        'is_preview',
        'status',
        'ordinal_number',
        'module_id',
    ];
}
