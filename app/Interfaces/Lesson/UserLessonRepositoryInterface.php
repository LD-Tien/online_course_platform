<?php

namespace App\Interfaces\Lesson;

use App\Interfaces\CrudRepositoryInterface;

interface UserLessonRepositoryInterface extends CrudRepositoryInterface
{
    public function customDelete(int $userId, int $lessonId);
}