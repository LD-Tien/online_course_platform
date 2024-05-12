<?php

namespace App\Interfaces\Lesson;

use App\Interfaces\CrudRepositoryInterface;

interface LessonRepositoryInterface extends CrudRepositoryInterface
{
    public function getAllByField($column, $value, $operator = '=');
}