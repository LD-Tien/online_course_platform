<?php

namespace App\Services\Course;

use App\Interfaces\Course\CourseRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class GetAllByFieldService extends BaseService
{
    protected $courseRepository;
    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function handle()
    {
        try {
            return $this->courseRepository->getAllByField($this->data['column'], $this->data['value']);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

