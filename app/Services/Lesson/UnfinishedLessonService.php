<?php

namespace App\Services\Lesson;

use App\Interfaces\Lesson\UserLessonRepositoryInterface;
use App\Repositories\Lesson\UserLessonRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class UnfinishedLessonService extends BaseService
{
    protected $lessonRepository;

    public function __construct(UserLessonRepositoryInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function handle()
    {
        try {
            return $this->lessonRepository->customDelete($this->data['user_id'], $this->data['lesson_id']);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

