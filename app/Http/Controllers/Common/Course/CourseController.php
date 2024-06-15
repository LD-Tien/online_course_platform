<?php

namespace App\Http\Controllers\Common\Course;

use App\Enums\CourseStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\Common\Course\CourseResource;
use App\Models\Course;
use App\Services\Course\GetCourseByQueryService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query();
        $query['filters'] = ['status' => CourseStatus::PUBLISHED];
        $result = resolve(GetCourseByQueryService::class)->setParams($query)->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.get_success'),
                'data' => CourseResource::collection($result)
            ]);
        }

        return $this->responseError(__('messages.get_fail'));
    }

    public function show(Request $request, Course $course)
    {
        return $this->responseSuccess([
            'message' => __('messages.get_success'),
            'data' => new CourseResource($course)
        ]);
    }
}
