<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Services\Category\CreateCategoryService;
use App\Services\Category\DeleteCategoryService;
use App\Services\Category\FindCategoryService;
use App\Services\Category\GetAllByFieldService;
use App\Services\Category\UpdateCategoryService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = resolve(GetAllByFieldService::class)->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.category.get_all_success'),
                'data' => $result
            ]);
        }

        return $this->responseErrors(__('messages.category.get_all_fail'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = resolve(CreateCategoryService::class)->setParams()->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.category.create_success'),
                'data' => $result
            ], Response::HTTP_CREATED);
        }

        return $this->responseErrors(__('messages.category.create_fail'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = resolve(FindCategoryService::class)->setParams(['id' => $id])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.category.get_success'),
                'data' => $result
            ]);
        }

        return $this->responseErrors(__('messages.category.get_fail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = resolve(UpdateCategoryService::class)->setParams([...$request->all(), 'id' => $id])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.category.update_success'),
                'data' => $result
            ]);
        }

        return $this->responseErrors(__('messages.category.update_fail'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = resolve(DeleteCategoryService::class)->setParams(['id' => $id])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.category.delete_success'),
                'data' => $result
            ]);
        }

        return $this->responseErrors(__('messages.category.delete_fail'));
    }
}
