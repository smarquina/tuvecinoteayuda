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
use App\Http\Managers\Auth\VerifyUserManager;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\VerificationRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User\User;
use App\Models\User\UserStatus;
use App\Models\User\UserType;
use App\Resources\User\UserResource;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;


/**
 * Class AuthController
 * @package App\Http\Controllers\Api
 */
class AuthController extends ApiController {

    /**
     * Register new user
     *
     * @param UserRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Post(
     *   path="/api/public/auth/register",
     *   summary="Register new user",
     *   tags={"user"},
     *   operationId="register",
     *   @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string",
     *                     description="required",
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="required",
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     description="required",
     *                 ),
     *                  @OA\Property(
     *                     property="address",
     *                     type="string",
     *                     description="required",
     *                 ),
     *                  @OA\Property(
     *                     property="city",
     *                     type="string",
     *                     description="required",
     *                 ),
     *                  @OA\Property(
     *                     property="state",
     *                     type="string",
     *                     description="required",
     *                 ),
     *                  @OA\Property(
     *                     property="zip_code",
     *                     type="string",
     *                     description="required",
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
     *                @OA\Property(
     *                     property="activity_areas_id",
     *                     type="integer",
     *                     description="required. only for associations",
     *                 ),
     *                @OA\Property(
     *                     property="user_type_id",
     *                     type="integer",
     *                     description="required. volunteer, requester, association",
     *                 ),
     *                @OA\Property(
     *                     property="nearby_areas_id",
     *                     type="integer",
     *                     description="required. only for volunteer",
     *                 ),
     *                @OA\Property(
     *                     property="corporate_name",
     *                     type="string",
     *                     description="Nullable. required for associations",
     *                 ),
     *                @OA\Property(
     *                     property="cif",
     *                     type="string",
     *                     description="Nullable. required for associations",
     *                 ),
     *             )
     *         )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="User and token",
     *    @OA\JsonContent(type="object",
     *       @OA\Property(property="user", ref="#/components/schemas/User"),
     *       @OA\Property(property="token", type="string"),
     *     ),
     *  ),
     * @OA\Response(response="422", description="Request invalid. see errors"),
     * )
     *
     */
    public function register(UserRequest $request) {
        try {
            $user                  = new User($request->except('password'));
            $user->password        = \Hash::make($request->input('password'));
            $user->remember_token  = \Str::random(100);
            $user->user_status_id  = UserStatus::ACTIVE;
            $user->nearby_areas_id = $user->user_type_id == UserType::USER_TYPE_VOLUNTEER ? $user->nearby_areas_id : null;
            $user->save();

            event(new Registered($user));

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
     *
     * @OA\Post(
     *   path="/api/public/auth/login",
     *   summary="Login users",
     *   tags={"auth"},
     *   operationId="login",
     *   @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="user",
     *                     type="string",
     *                     description="required. phone or email"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string|required"
     *                 ),
     *                 example={"nick": "smarquina", "password": "XXXX"}
     *             )
     *         )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="User and token",
     *    @OA\JsonContent(type="object",
     *       @OA\Property(property="user", ref="#/components/schemas/User"),
     *       @OA\Property(property="token", type="string"),
     *     ),
     *  ),
     * @OA\Response(response="550", description="User not found / invalid credentials."),
     * )
     *
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

    /**
     * Verify DNI service.
     *
     * @param VerificationRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *   path="/api/user/verify",
     *   summary="Verify DNI service",
     *   tags={"auth", "user"},
     *   operationId="verifyUserData",
     *   @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Required. Same full name as DNI"
     *                 ),
     *                 @OA\Property(
     *                     property="dni",
     *                     type="string",
     *                     description="Required"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     type="string|required",
     *                     description="Required. Base64 image",
     *                 ),
     *             )
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
     * @OA\Response(response="400", description="Error connection / not verifiable"),
     * @OA\Response(response="422", description="Request invalid. see errors"),
     * )
     *
     */
    public function verifyUserData(VerificationRequest $request) {
        try {
            /** @var User $user */
            $user       = \Auth::user();
            $user->name = ucwords(Str::lower($request->input('name')));

            if (VerifyUserManager::dniValidator($request->input('dni'))) {
                $user->cif = Str::upper($request->input('dni'));

                \Image::make($request->input('image'))
                      ->fit(800)
                      ->encode('jpg')
                      ->save(storage_path("app/private/verifications/{$user->id}.jpg"));

                $response = VerifyUserManager::verifyUser($request->input('image'), $user);
                if ($response->verified) {
                    $user->verified = true;
                    $user->save();

                    return $this->responseOK(trans('user.verification.correct'));
                } else {
                    return $response->response instanceof Response
                        ? $this->responseWithError($response->response->status(), $response->response->body())
                        : $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, trans('user.verification.error'));
                }
            } else {
                throw new \Exception(trans('user.verification.dni_invalid'));
            }
        } catch (\Exception $exception) {
            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, $exception->getMessage());
        }
    }
}
