<?php

namespace App\Repositories\Lesson;

use App\Interfaces\Lesson\LessonRepositoryInterface;
use App\Models\Lesson;
use App\Repositories\BaseRepository;

class LessonRepository extends BaseRepository implements LessonRepositoryInterface
{
    public function __construct(Lesson $lesson)
    {
        $this->model = $lesson;
    }

    public function getAllByField($column, $value, $operator = '=')
    {
        return $this->model->where($column, $operator, $value)->get();
    }

    public function finishLesson($userId, $lessonId)
    {

    }
}