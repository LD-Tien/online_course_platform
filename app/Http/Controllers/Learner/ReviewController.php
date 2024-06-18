<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Services\Review\UpdateOrCreateReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $result = resolve(UpdateOrCreateReviewService::class)->setParams([
            'course_id' => $request->input('course_id'),
            'rating_value' => $request->input('rating_value'),
            'comment' => $request->input('comment') ?? '',
            'user_id' => Auth::id()
        ])->handle();

        if ($result) {
            return $this->responseSuccess([
                'message' => __('messages.create_success'),
                'data' => $result
            ]);
        }

        return $this->responseErrors(__('messages.create_fail'));
    }
}
