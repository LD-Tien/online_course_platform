<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Services\Category\CreateCategoryService;
use App\Services\Category\DeleteCategoryService;
use App\Services\Category\FindCategoryService;
use App\Services\Category\GetCategoryByQueryService;
use App\Services\Category\UpdateCategoryService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->query();
        $result = resolve(GetCategoryByQueryService::class)->setParams($query)->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.get_success'),
                'data' => new CategoryCollection($result),
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
        $result = resolve(CreateCategoryService::class)->setParams($request->all())->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.create_success'),
                'data' => $result
            ], Response::HTTP_CREATED);
        }

        return $this->responseErrors(__('messages.create_fail'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = resolve(FindCategoryService::class)->setParams(['id' => $id])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.get_success'),
                'data' => $result
            ]);
        }

        return $this->responseErrors(__('messages.get_fail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = resolve(UpdateCategoryService::class)->setParams([...$request->all(), 'id' => $id])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.update_success'),
                'data' => $result
            ]);
        }

        return $this->responseErrors(__('messages.update_fail'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = resolve(DeleteCategoryService::class)->setParams(['id' => $id])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.delete_success'),
                'data' => $result
            ]);
        }

        return $this->responseErrors(__('messages.delete_fail'));
    }
}
