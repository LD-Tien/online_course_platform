<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Services\User\UpdateUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RegisterInstructorController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->all();
        $data = [
            ...$data,
            'old_avatar_url' => Auth::user()->profile_photo_url,
            'id' => Auth::id(),
            'role' => UserRole::INSTRUCTOR
        ];

        $user = resolve(UpdateUserService::class)->setParams($data)->Handle();

        if (!$user) {
            return $this->responseErrors('Register instructor failed.');
        }

        return $this->responseSuccess([
            'message' => 'Registered instructor successfully',
            'data' => $user
        ]);
    }
}
