<?php

namespace App\Services\Lesson;

use App\Interfaces\Lesson\LessonRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DeleteLessonService extends BaseService
{
    protected $lessonRepository;
    public function __construct(LessonRepositoryInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function handle()
    {
        try {
            $this->lessonRepository->delete($this->data['id']);
            Storage::delete($this->data['video_path']);

            return true;
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

