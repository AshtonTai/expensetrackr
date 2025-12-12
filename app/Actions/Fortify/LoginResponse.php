<?php

declare(strict_types=1);

// app/Actions/Fortify/LoginResponse.php

namespace App\Actions\Fortify;

use Inertia\Inertia;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

final class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // Redirect to dashboard after login
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : Inertia::location(route('dashboard'));
    }
}
