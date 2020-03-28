<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends ApiController {
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Send a reset link to the given user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     *
     * @OA\Post(
     *   path="/api/public/auth/password/email",
     *   summary="Request reset email",
     *   tags={"password", "user"},
     *   operationId="sendResetLinkEmail",
     *   @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     description="email, required"
     *                 ),
     *              ),
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
    public function sendResetLinkEmail(Request $request) {
        $this->validateEmail($request);
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        //Always return as OK even if email doesn't exist. Do not expose mails.
        return $this->responseOK(trans($response));
        /*if ($response == \Password::RESET_LINK_SENT) {} else {
            throw ValidationException::withMessages(['email' => [trans($response)]]);
        }*/
    }
}
