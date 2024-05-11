<?php

namespace App\Services\Course;

use App\Interfaces\Course\CourseRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DeleteCourseService extends BaseService
{
    protected $courseRepository;
    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function handle()
    {
        try {
            $this->courseRepository->delete($this->data['deleteCourse']['id']);
            Storage::delete($this->data['deleteCourse']['thumbnail_path']);

            return true;
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

