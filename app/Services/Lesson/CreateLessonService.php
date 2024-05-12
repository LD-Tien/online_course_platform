<?php

namespace App\Services\Lesson;

use App\Interfaces\Lesson\LessonRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CreateLessonService extends BaseService
{
    protected $lessonRepository;
    public function __construct(LessonRepositoryInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function handle()
    {
        try {
            $this->data['id'] = hexdec(uniqid());

            if ($this->data['video_file']) {
                $file = $this->data['video_file'];
                $path = "public/uploads/user_{$this->data['user_id']}/course_{$this->data['course_id']}/lesson_{$this->data['id']}";
                $videoPath = Storage::putFile($path, $file);
                $this->data['video_path'] = $videoPath ?? '';
            }

            return $this->lessonRepository->create($this->data);
        } catch (Exception $e) {
            Log::info($e);
            Storage::delete($videoPath);

            return false;
        }
    }
}

