<?php

namespace App\Repositories\Course;

use App\Interfaces\Course\CourseRepositoryInterface;
use App\Models\Course;
use App\Repositories\BaseRepository;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function __construct(Course $course)
    {
        $this->model = $course;
    }
}