<?php

namespace App\Http\Middleware;

use App\Http\Enums\HttpErrors;
use Closure;

class VerifyUserType {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param array                    $userTypes
     * @return mixed
     */
    public function handle($request, Closure $next, ...$userTypes) {
        if (\Auth::check() && in_array(\Auth::user()->user_type, $userTypes)) {
            return $next($request);
        } else {
            $code = HttpErrors::HTTP_FORBIDDEN;
            return response()->json(["message"     => trans('auth.user_type.denied'),
                                     "code"        => $code,
                                     "status_code" => $code,
                                     "status"      => HttpErrors::$messages[$code],
                                    ], $code);
        }
    }
}
