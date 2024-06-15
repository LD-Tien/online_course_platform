<?php

namespace App\Repositories\Lesson;

use App\Interfaces\Lesson\UserLessonRepositoryInterface;
use App\Models\Lesson;
use App\Models\UserLesson;
use App\Repositories\BaseRepository;

class UserLessonRepository extends BaseRepository implements UserLessonRepositoryInterface
{
    public function __construct(UserLesson $lesson)
    {
        $this->model = $lesson;
    }

    public function customDelete(int $userId, int $lessonId)
    {
        return $this->model->where('user_id', $userId)->where('lesson_id', $lessonId)->delete();
    }
}