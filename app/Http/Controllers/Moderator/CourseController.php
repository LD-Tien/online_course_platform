<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Resources\Course\CourseCollection;
use App\Http\Resources\Course\CourseResource;
use App\Models\Course;
use App\Services\Course\GetCourseByQueryService;
use Illuminate\Http\Request;

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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
