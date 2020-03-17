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
use App\Models\User\UserType;
use App\Resources\User\UserCollection;
use App\Resources\User\UserResource;
use Illuminate\Support\Facades\Request;

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
            $user->update($request->only(['nearby_areas_id', 'address', 'city', 'state', 'zip_code']));
            $user->save();

            return response()->json(['msg'  => trans('general.model.update.correct', ['value' => $user->name]),
                                     'user' => new UserResource($user)]);

        } catch (\Exception $exception) {
            \Log::error($exception);
            $msg = config('app.debug') ? $exception->getMessage() : trans('general.model.update.error');

            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, $msg);
        }
    }

    /**
     * List help requests based on user type
     *
     * @return HelpRequestsCollection
     */
    public function associations() {
        $associations = User::whereUserTypeId(UserType::USER_TYPE_ASSOCIATION)->get();
        return new UserCollection($associations);
    }
}
