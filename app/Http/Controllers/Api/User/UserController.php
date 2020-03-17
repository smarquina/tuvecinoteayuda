<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 14/03/2020
 * Time: 23:30
 */

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Http\Enums\HttpErrors;
use App\Http\Requests\User\UserRequest;
use App\Models\User\User;
use App\Resources\User\UserResource;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends ApiController {

    /**
     * Get user profile.
     *
     * @return UserResource
     */
    public function profile() {
        return new UserResource(\Auth::user());
    }

    /**
     * Update user resource with given params.
     *
     * @param UserRequest $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request) {
        try {
            /** @var User $user */
            $user = \Auth::user();
            $user->update($request->except(['password', 'user_type_id']));
            $user->save();

            return new UserResource($user);

        } catch (\Exception $exception) {
            \Log::error($exception);
            $msg = config('app.debug') ? $exception->getMessage() : trans('general.model.update.error');

            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, $msg);
        }
    }
}
