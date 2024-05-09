<?php

namespace App\Services\Course;

use App\Interfaces\Course\CourseRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class CreateCourseService extends BaseService
{
    protected $courseRepository;
    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function handle()
    {
        try {
            return $this->courseRepository->create($this->data);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

