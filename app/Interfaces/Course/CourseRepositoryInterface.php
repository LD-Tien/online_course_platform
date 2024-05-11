<?php

namespace App\Interfaces\Course;

use App\Interfaces\CrudRepositoryInterface;

interface CourseRepositoryInterface extends CrudRepositoryInterface
{
    public function getAllByField($column, $value, $operator = '=');
}