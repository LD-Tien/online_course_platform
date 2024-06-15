<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Services\Category\GetCategoryByQueryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = [
            'sorts' => [
                'name' => 'asc'
            ]
        ];
        $result = resolve(GetCategoryByQueryService::class)->setParams($query)->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.get_success'),
                'data' => CategoryResource::collection($result),
            ]);
        }

        return $this->responseErrors(__('messages.get_fail'));
    }
}
