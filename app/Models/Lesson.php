<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lesson';

    protected $fillable = [
        'id',
        'name',
        'video_path',
        'duration',
        'description',
        'is_preview',
        'status',
        'ordinal_number',
        'module_id',
        'analysis_text_result_json',
        'analysis_video_result_json'
    ];

    public function userLessons(): HasMany
    {
        return $this->hasMany(UserLesson::class, 'lesson_id');
    }

    public function getFinishTime(int $userId)
    {
        $userLesson = $this->userLessons()->where('user_id', $userId)->first();
        return $userLesson ? $userLesson->completed_at : null;
    }
}
