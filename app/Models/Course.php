<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'course';

    protected $fillable = [
        'id',
        'thumbnail_path',
        'course_name',
        'description',
        'price',
        'is_progress_limited',
        'category_id',
        'user_id',
        'status',
    ];
}
