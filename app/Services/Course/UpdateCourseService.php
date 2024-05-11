<?php

namespace App\Services\Course;

use App\Interfaces\Course\CourseRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UpdateCourseService extends BaseService
{
    protected $courseRepository;
    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function handle()
    {
        try {
            if ($this->data['dataUpdate']['thumbnail_file']) {
                Storage::delete($this->data['course']['thumbnail_path']);
                $file = $this->data['dataUpdate']['thumbnail_file'];
                $path = "public/uploads/user_{$this->data['course']['user_id']}/course_{$this->data['course']['id']}/thumbnail";
                $this->data['dataUpdate']['thumbnail'] = Storage::putFile($path, $file) ?? '';
            }

            return $this->courseRepository->update($this->data['dataUpdate'], $this->data['course']['id']);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

