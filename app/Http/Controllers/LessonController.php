<?php

namespace App\Http\Controllers;

use App\Http\Resources\Lesson\LessonResource;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Services\Lesson\CreateLessonService;
use App\Services\Lesson\DeleteLessonService;
use App\Services\Lesson\UpdateLessonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course, Module $module)
    {
        return $this->responseSuccess([
            'message' => __('messages.get_success'),
            'data' => LessonResource::collection($module->lessons)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course, Module $module)
    {
        $result = resolve(CreateLessonService::class)
            ->setParams([
                ...$request->all(),
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'module_id' => $module->id
            ])
            ->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.create_success'),
                'data' => new LessonResource($result)
            ], Response::HTTP_CREATED);
        }

        return $this->responseErrors(__('messages.create_fail'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course, Module $module, Lesson $lesson)
    {
        return $this->responseSuccess([
            'message' => __('messages.get_success'),
            'data' => new LessonResource($lesson),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course, Module $module, Lesson $lesson)
    {
        $result = resolve(UpdateLessonService::class)->setParams([
            'dataUpdate' => $request->all(),
            'user_id' => $course->user_id,
            'course_id' => $course->id,
            'module_id' => $module->id,
            'lesson' => $lesson
        ])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.update_success'),
                'data' => new LessonResource($result)
            ]);
        }

        return $this->responseErrors(__('messages.update_fail'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, Module $module, Lesson $lesson)
    {
        $result = resolve(DeleteLessonService::class)->setParams($lesson)->handle();

        if ($result) {
            return $this->responseSuccess(['message' => __('messages.delete_success')]);
        }

        return $this->responseErrors(__('messages.delete_fail'));
    }
}
