<?php

namespace App\Services\Course;

use App\Interfaces\Course\CourseRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
            $this->data['id'] = hexdec(uniqid());

            if ($this->data['thumbnail_file']) {
                $file = $this->data['thumbnail_file'];
                $path = "public/uploads/user_{$this->data['user_id']}/course_{$this->data['id']}/thumbnail";
                $thumbnail_path = Storage::putFile($path, $file);
                $this->data['thumbnail_path'] = $thumbnail_path ?? '';
            }

            return $this->courseRepository->create($this->data);
        } catch (Exception $e) {
            Log::info($e);

            Storage::delete($thumbnail_path);

            return false;
        }
    }
}

