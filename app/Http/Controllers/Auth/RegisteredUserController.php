<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\User\CreateUserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RegisteredUserController extends Controller
{
    public function store(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = resolve(CreateUserService::class)->setParams($data)->Handle();

        if (!$user) {
            return $this->responseErrors('Register failed');
        }

        event(new Registered($user));

        return $this->responseSuccess([
            'message' => 'Registered successfully',
            'data' => $user
        ], Response::HTTP_CREATED);
    }
}
