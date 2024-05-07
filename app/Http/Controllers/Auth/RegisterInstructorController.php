<?php

namespace App\Http\Controllers\Auth;

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
            'id' => Auth::id(),
            'role' => $data['role']
        ];
        $user = resolve(UpdateUserService::class)->setParams($data)->Handle();

        if (!$user) {
            return $this->responseErrors('Register instructor failed');
        }

        return $this->responseSuccess([
            'message' => 'Registered instructor successfully',
            'data' => $user
        ]);
    }
}
