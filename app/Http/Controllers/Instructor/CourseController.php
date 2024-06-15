<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Course\CourseCollection;
use App\Http\Resources\Course\CourseResource;
use App\Models\Course;
use App\Services\Course\CreateCourseService;
use App\Services\Course\DeleteCourseService;
use App\Services\Course\GetCourseByQueryService;
use App\Services\Course\UpdateCourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $query = $request->query();
        $query['filters']['user_id'] = Auth::id();
        $result = resolve(GetCourseByQueryService::class)
            ->setParams($query)
            ->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.get_success'),
                'data' => new CourseCollection($result),
                'meta' => [
                    'current_page' => $result->currentPage(),
                    'from' => $result->firstItem(),
                    'last_page' => $result->lastPage(),
                    'path' => $result->path(),
                    'per_page' => $result->perPage(),
                    'to' => $result->lastItem(),
                    'total' => $result->total(),
                ],
            ]);
        }

        return $this->responseErrors(__('messages.get_fail'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = resolve(CreateCourseService::class)
            ->setParams([...$request->all(), 'user_id' => Auth::id()])
            ->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.create_success'),
                'data' => new CourseResource($result)
            ], Response::HTTP_CREATED);
        }

        return $this->responseErrors(__('messages.create_fail'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return $this->responseSuccess([
            'message' => __('messages.get_success'),
            'data' => new CourseResource($course),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $result = resolve(UpdateCourseService::class)->setParams(['course' => $course, 'dataUpdate' => $request->all()])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.update_success'),
                'data' => new CourseResource($result)
            ]);
        }

        return $this->responseErrors(__('messages.update_fail'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $result = resolve(DeleteCourseService::class)->setParams(['deleteCourse' => $course])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.delete_success')
            ]);
        }

        return $this->responseErrors(__('messages.delete_fail'));
    }
}
