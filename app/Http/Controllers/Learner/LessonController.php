<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Services\Lesson\FinishLessonService;
use App\Services\Lesson\UnfinishedLessonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function finishLesson(Request $request, Lesson $lesson)
    {
        $result = resolve(FinishLessonService::class)->setParams([
            'user_id' => Auth::id(),
            'lesson_id' => $lesson->id
        ])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.create_success'),
                'data' => $result
            ]);
        }

        return $this->responseErrors(__('messages.create_fail'));
    }

    public function unfinishedLesson(Request $request, Lesson $lesson)
    {
        $result = resolve(UnfinishedLessonService::class)->setParams([
            'user_id' => Auth::id(),
            'lesson_id' => $lesson->id
        ])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.delete_success'),
            ]);
        }

        return $this->responseErrors(__('messages.delete_fail'));
    }
}
