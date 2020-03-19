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
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User\User;
use App\Models\User\UserStatus;
use App\Models\User\UserType;
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
            $user                  = new User($request->except('password'));
            $user->password        = \Hash::make($request->input('password'));
            $user->remember_token  = \Str::random(100);
            $user->user_status_id  = UserStatus::ACTIVE;
            $user->nearby_areas_id = $user->user_type_id == UserType::USER_TYPE_VOLUNTEER ? $user->nearby_areas_id : null;
            $user->save();

            $token = \JWTAuth::fromUser($user);
            return response()->json(array('user' => $user, 'token' => $token));
        } catch (\Exception $exception) {
            \Log::error($exception);
            $msg = config('app.debug') ? $exception->getMessage() : trans('auth.login.noToken');
            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, $msg);
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
            if (\Auth::attempt($credentials)) {
                //Need once to bypass the resource conversion
                \Auth::onceUsingId($user->id);

                return response()->json(['token' => \JWTAuth::fromUser($user),
                                         'user'  => new UserResource($user),
                                        ]);
            } else {
                return $this->responseWithError(HttpErrors::CANT_COMPLETE_REQUEST, trans('auth.login.invalidCred'));
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->responseWithError(HttpErrors::CANT_COMPLETE_REQUEST, trans('auth.login.noToken'));
        } catch (\Exception $exception) {
            return $this->responseWithError(HttpErrors::CANT_COMPLETE_REQUEST, trans('auth.login.userNoExist'));
        }
    }
}
