<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Services\Lesson\UpdateLessonService;
use App\Services\Moderation\CourseModerationByAiService;
use App\Services\Moderation\LessonModerationByAiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseModerationController extends Controller
{
    /**
     * Start course analysis
     * 
     * @param Course $course
     * 
     * @return \Illuminate\Http\Response
     */
    public function startCourseAnalysis(Course $course)
    {
        $result = resolve(CourseModerationByAiService::class)->setParams(['course' => $course])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.start_analysis_course_success')
            ]);
        }

        return $this->responseErrors(__('messages.start_analysis_course_fail'));
    }

    /**
     * Start lesson analysis
     * 
     * @param Course $course
     * @param Module $module
     * @param Lesson $lesson
     * 
     * @return \Illuminate\Http\Response
     */
    public function startLessonAnalysis(Course $course, Module $module, Lesson $lesson)
    {
        $result = resolve(LessonModerationByAiService::class)->setParams(['lesson' => $lesson])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.start_analysis_lesson_success'),
            ]);
        }

        return $this->responseErrors(__('messages.start_analysis_lesson_fail'));
    }

    /**
     * Handle webhook moderation video from Eden AI
     * 
     * @param Request $request
     * @param Lesson $lesson
     * 
     * @return \Illuminate\Http\Response
     */
    public function handleVideoReviewResult(Request $request, Lesson $lesson)
    {
        $data = [
            'dataUpdate' => [
                'id' => $lesson->id,
                'analysis_video_result_json' => json_encode($request->all())
            ],
            'lesson' => $lesson
        ];

        $result = resolve(UpdateLessonService::class)->setParams($data)->handle();

        if (!$result) {
            Log::error('Error when update lesson in handle video moderation result');
        }

        return $this->responseSuccess([]);
    }
}
