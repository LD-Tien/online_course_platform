<?php

namespace App\Services\Lesson;

use App\Repositories\Lesson\UserLessonRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class FinishLessonService extends BaseService
{
    protected $lessonRepository;

    public function __construct(UserLessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function handle()
    {
        try {
            return $this->lessonRepository->create($this->data);
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}

