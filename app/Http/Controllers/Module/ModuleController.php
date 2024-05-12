<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Resources\Module\ModuleResource;
use App\Models\Course;
use App\Models\Module;
use App\Services\Module\UpdateModuleService;
use App\Services\Module\CreateModuleService;
use App\Services\Module\DeleteModuleService;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Get listing of the resource.
     */
    public function index(Course $course)
    {
        return $this->responseSuccess([
            'message' => __('messages.get_success'),
            'data' => ModuleResource::collection($course->modules)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $result = resolve(CreateModuleService::class)
            ->setParams([...$request->all(), 'course_id' => $course->id])
            ->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.create_success'),
                'data' => new ModuleResource($result)
            ]);
        }

        return $this->responseErrors(__('messages.create_fail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course, Module $module)
    {
        $result = resolve(UpdateModuleService::class)
            ->setParams([...$request->all(), 'id' => $module->id])
            ->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.update_success'),
                'data' => new ModuleResource($result)
            ]);
        }

        return $this->responseErrors(__('messages.delete_fail'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, Module $module)
    {
        $result = resolve(DeleteModuleService::class)->setParams(['id' => $module->id])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.delete_success'),
            ]);
        }

        return $this->responseErrors(__('messages.delete_fail'));
    }
}
