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
use Illuminate\Http\Request;

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
     * List associations based on user type.
     *
     * @return UserCollection
     */
    public function associations() {
        $associations = User::whereUserTypeId(UserType::USER_TYPE_ASSOCIATION)->get();
        return new UserCollection($associations, true);
    }

    /**
     * List of my associated users.
     *
     * @return UserCollection|\Illuminate\Http\JsonResponse
     */
    public function associates() {
        /** @var User $user */
        $user = \Auth::user();

        if ($user->user_type_id == UserType::USER_TYPE_ASSOCIATION) {
            return new UserCollection($user->associates, true);
        } else {
            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST,
                                            trans('auth.user_type.denied'));
        }
    }

    /**
     * Join association.
     *
     * @param Request $request
     * @param int     $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function joinAssociation(Request $request, $id) {
        try {
            $association = User::whereUserTypeId(UserType::USER_TYPE_ASSOCIATION)
                               ->whereId($id)
                               ->first();

            if ($association instanceof User) {
                /** @var User $user */
                $user = \Auth::user();
                $user->associations()->syncWithoutDetaching([$association->id]);

                return $this->responseOK(trans('user.association.join.correct',
                                               ['value' => $association->corporate_name]));
            } else {
                return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST,
                                                trans('user.association.join.error'));
            }
        } catch (\Exception $exception) {
            \Log::error($exception);
            $msg = config('app.debug') ? $exception->getMessage() : trans('user.association.join.error');
            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, $msg);
        }
    }

    /**
     * Detach user from given association.
     *
     * @param Request $request
     * @param int     $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachAssociation(Request $request, $id) {
        try {
            $association = User::whereUserTypeId(UserType::USER_TYPE_ASSOCIATION)
                               ->whereId($id)
                               ->first();

            /** @var User $user */
            $user = \Auth::user();

            if ($association instanceof User &&
                $user->associations->contains('id', $association->id)) {

                $user->associations()->detach([$association->id]);
                return $this->responseOK(trans('user.association.detach.correct',
                                               ['value' => $association->corporate_name]));
            } else {
                return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST,
                                                trans('user.association.detach.error'));
            }
        } catch (\Exception $exception) {
            \Log::error($exception);
            $msg = config('app.debug') ? $exception->getMessage() : trans('user.association.detach.error');
            return $this->responseWithError(HttpErrors::HTTP_BAD_REQUEST, $msg);
        }
    }
}
