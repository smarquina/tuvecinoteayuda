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
     *
     * @OA\Post(
     *   path="/api/public/auth/password/reset",
     *   summary="Reset password",
     *   tags={"password", "user"},
     *   operationId="reset",
     *   @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     description="email, required"
     *                 ),
     *                 @OA\Property(
     *                     property="token",
     *                     type="string",
     *                     description="Token reciebed from email"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     description="required",
     *                 ),
     *                @OA\Property(
     *                     property="password_confirmation",
     *                     type="string",
     *                     description="required. must match password",
     *                 ),
     *             ),
     *         )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Ok response",
     *    @OA\JsonContent(type="object",
     *       @OA\Property(property="message", type="string"),
     *       @OA\Property(property="status_code", type="integer"),
     *       @OA\Property(property="status", type="string"),
     *     ),
     *  ),
     * @OA\Response(response="400", description="Error ocurred"),
     * @OA\Response(response="422", description="Request invalid. see errors"),
     * )
     *
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
