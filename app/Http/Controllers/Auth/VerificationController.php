<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Enums\HttpErrors;
use App\Models\User\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     */
    public function verify(Request $request) {
        try {
            /** @var User $user */
            $user = User::findOrFail($request->route('id'));

            if (!hash_equals((string)$request->route('hash'), sha1($user->getEmailForVerification()))) {
                throw new AuthorizationException;
            }

            if ($user->hasVerifiedEmail()) {
                return redirect()->away(config('app.url_front'),
                                        HttpErrors::HTTP_MOVED_PERMANENTLY,
                                        ['verified' => true]);
            }

            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }

            return redirect()->away(config('app.url_front'),
                                    HttpErrors::HTTP_MOVED_PERMANENTLY,
                                    ['verified' => true]);
        } catch (\Exception $exception) {
            return redirect()->away(config('app.url_front'),
                                    HttpErrors::HTTP_MOVED_PERMANENTLY,
                                    ['verified' => false]);
        }
    }
}
