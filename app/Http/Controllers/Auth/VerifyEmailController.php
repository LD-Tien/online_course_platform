<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\User\FindUserByIdService;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $user = resolve(FindUserByIdService::class)->setParams($request->id)->handle();

        if ($user) {
            if ($user->hasVerifiedEmail()) {
                return redirect()->intended(
                    config('app.frontend_url') . '/login' . '?verified=1'
                );
            }

            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
        }

        return redirect()->intended(
            config('app.frontend_url') . '/login' . '?verified=1'
        );
    }
}
