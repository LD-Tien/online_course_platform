<?php

namespace App\Repositories\Enrollment;

use App\Interfaces\Enrollment\EnrollmentRepositoryInterface;
use App\Models\Enrollment;
use App\Repositories\BaseRepository;

class EnrollmentRepository extends BaseRepository implements EnrollmentRepositoryInterface
{
    public function __construct(Enrollment $enrollment)
    {
        $this->model = $enrollment;
    }
}