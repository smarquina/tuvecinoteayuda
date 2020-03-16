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
use App\Resources\User\UserResource;
use Tymon\JWTAuth\Exceptions\JWTException;


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
        try {
            if (filter_var($request->input("user"), FILTER_VALIDATE_EMAIL)) {
                /** @var User $user */
                $user = User::whereEmail($request->input("user"))->firstOrFail();
            } else {
                /** @var User $user */
                $user = User::wherePhone($request->input("user"))->firstOrFail();
            }

            $credentials = ['email' => $user->email, 'password' => $request->input('password')];
            if (!$token = auth()->guard('api')->attempt($credentials)) {
                return $this->responseWithError(HttpErrors::CANT_COMPLETE_REQUEST, trans('auth.login.invalidCred'));
            } else {
                //Need once to bypass the resource conversion
                \Auth::onceUsingId($user->id);

                return response()->json(['token' => $token,
                                         'user'  => new UserResource($user),
                                        ]);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->responseWithError(HttpErrors::CANT_COMPLETE_REQUEST, trans('auth.login.noToken'));
        } catch (\Exception $exception) {
            return $this->responseWithError(HttpErrors::CANT_COMPLETE_REQUEST, trans('auth.login.userNoExist'));
        }
    }
}
