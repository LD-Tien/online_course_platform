<?php

namespace App\Http\Controllers\Common\Review;

use App\Http\Controllers\Controller;
use App\Http\Resources\Common\Review\ReviewResource;
use App\Services\Review\GetReviewByQuery;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(int $courseId)
    {
        $query = [
            'filters' => [
                'course_id' => $courseId
            ],
        ];
        $result = resolve(GetReviewByQuery::class)->setParams($query)->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.get_success'),
                'data' => ReviewResource::collection($result)
            ]);
        }

        return $this->responseErrors(__('messages.get_fail'));
    }
}
