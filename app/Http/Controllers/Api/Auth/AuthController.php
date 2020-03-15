<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 15/03/2020
 * Time: 12:00
 */

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Enums\HttpErrors;
use app\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User;


use Illuminate\Http\Request;
use Validator, Redirect, Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;


/**
 * Class AuthController
 * @package App\Http\Controllers\Api
 */
class AuthController extends ApiController {

    /**
     * Store user resource.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRequest $request) {
        try {
            $user                 = new User($request->except('password'));
            $user->password       = \Hash::make($request->input('password'));
            $user->remember_token = \Str::random(100);
            $user->save();

            $token = \JWTAuth::fromUser($user);
            return response()->json(array('user' => $user, 'token' => $token));
        } catch (\Exception $exception) {
            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, trans('auth.login.noToken'));
        }
    }

    /**
     * Log in client
     *
     * @param LoginRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function login(LoginRequest $request) {
        $credentials = $request->only('phone', 'password');
        if (\Auth::attempt($credentials)) {
            $user  = Auth::user();
            $token = \JWTAuth::fromUser($user);

            return response()->json(['token' => $token]);
        } else {
            return $this->responseWithError(HttpErrors::HTTP_UNAUTHORIZED, trans('auth.login.invalidCred'));
        }
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return response('', 200);
    }
}
