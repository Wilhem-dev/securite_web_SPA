<?php

namespace App\Http\Responses;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request): Response|JsonResponse|RedirectResponse
    {
        $target = $this->determineRedirectPath($request);

        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        }

        return redirect()->intended($target);
    }

    private function determineRedirectPath(Request $request): string
    {
        $user = $request->user();
        $default = Fortify::redirects('login') ?? route('dashboard');

        if ($user instanceof User && $user->isAdmin()) {
            return route('admin.dashboard');
        }

        return $default;
    }
}

