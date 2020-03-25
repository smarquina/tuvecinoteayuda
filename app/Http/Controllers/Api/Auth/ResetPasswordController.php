<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends ApiController {
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Reset the given user's password.
     *
     * @param ResetPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function reset(ResetPasswordRequest $request) {
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        if ($response == \Password::PASSWORD_RESET) {
            return $this->responseOK(trans($response));
        } else {
            throw ValidationException::withMessages(['email' => [trans($response)]]);
        }
    }
}
