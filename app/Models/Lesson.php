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
        'analysis_text_result_json',
        'analysis_video_result_json'
    ];
}
