<?php

namespace App\Services\Lesson;

use App\Interfaces\Lesson\LessonRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UpdateLessonService extends BaseService
{
    protected $lessonRepository;
    public function __construct(LessonRepositoryInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function handle()
    {
        try {
            if (isset($this->data['dataUpdate']['video_file'])) {
                Storage::delete($this->data['lesson']['video_path']);
                $file = $this->data['dataUpdate']['video_file'];
                $path = "public/uploads/user_{$this->data['user_id']}/course_{$this->data['course_id']}/lesson_{$this->data['lesson']['id']}";
                $videoPath = Storage::putFile($path, $file);
                $this->data['dataUpdate']['video_path'] = $videoPath ?? '';
            }

            return $this->lessonRepository->update($this->data['dataUpdate'], $this->data['lesson']['id']);
        } catch (Exception $e) {
            Log::info($e);

            if (isset($videoPath)) {
                Storage::delete($videoPath);
            }

            return false;
        }
    }
}

