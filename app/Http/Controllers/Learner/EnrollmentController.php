<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\Enrollment\EnrollmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enrollment(Request $request, Course $course)
    {
        $result = resolve(EnrollmentService::class)->setParams([
            'user_id' => Auth::id(),
            'course_id' => $course->id
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
