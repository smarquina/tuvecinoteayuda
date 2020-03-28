<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/03/2020
 * Time: 23:49
 */

namespace App\Resources\User;


use App\Resources\ApiResource;
use App\Models\User\User;
use App\Models\User\UserType;

/**
 * Class UserResource
 * @package App\Http\Resources\User
 * @OA\Schema(schema="User", type="object")
 */
class UserResource extends ApiResource {

    /**
     * @OA\Property(
     *   property="id",
     *   type="integer",
     *   nullable=false,
     * )
     */

    /**
     * @OA\Property(
     *   property="name",
     *   type="string",
     *   nullable=false,
     * )
     */

    /**
     * @OA\Property(
     *   property="phone",
     *   type="string",
     *   nullable=false,
     * )
     */

    /**
     * @OA\Property(
     *   property="email",
     *   type="string",
     *   nullable=true,
     * )
     */

    /**
     * @OA\Property(
     *   property="user_type_id",
     *   type="object",
     *        @OA\Items(ref="#/components/schemas/UserType"),
     *   nullable=true,
     * )
     */

    /**
     * @OA\Property(
     *   property="user_type",
     *   type="object",
     *        @OA\Items(ref="#/components/schemas/UserType"),
     *   nullable=true,
     * )
     */

    /**
     * @OA\Property(
     *   property="corporate_name",
     *   type="string",
     *   nullable=true,
     * )
     */

    /**
     * @OA\Property(
     *   property="cif",
     *   type="string",
     *   nullable=true,
     * )
     */

    /**
     * @OA\Property(
     *   property="address",
     *   type="string",
     *   nullable=false,
     * )
     */

    /**
     * @OA\Property(
     *   property="city",
     *   type="string",
     *   nullable=false,
     * )
     */

    /**
     * @OA\Property(
     *   property="state",
     *   type="sting",
     *   nullable=false,
     * )
     */

    /**
     * @OA\Property(
     *   property="zip_code",
     *   type="string",
     *   nullable=false,
     * )
     */

    /**
     * @OA\Property(
     *   property="nearby_areas_id",
     *   type="object",
     *        @OA\Items(ref="#/components/schemas/NearbyAreas"),
     *   nullable=true,
     * )
     */

    /**
     * @OA\Property(
     *   property="nearby_areas",
     *   type="object",
     *        @OA\Items(ref="#/components/schemas/NearbyAreas"),
     *   nullable=true,
     * )
     */

    /**
     * @OA\Property(
     *   property="activity_areas_id",
     *   type="object",
     *        @OA\Items(ref="#/components/schemas/ActivityAreas"),
     *   nullable=true,
     * )
     */

    /**
     * @OA\Property(
     *   property="activity_areas",
     *   type="object",
     *        @OA\Items(ref="#/components/schemas/ActivityAreas"),
     *   nullable=true,
     * )
     */

    /**
     * @OA\Property(
     *   property="user_status_id",
     *   type="object",
     *        @OA\Items(ref="#/components/schemas/UserStatus"),
     *   nullable=true,
     * )
     */

    /**
     * @OA\Property(
     *   property="user_status",
     *   type="object",
     *        @OA\Items(ref="#/components/schemas/UserStatus"),
     *   nullable=true,
     * )
     */

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        /** @var User $user */
        $user = clone $this;

        $is_association = $user->user_type_id == UserType::USER_TYPE_ASSOCIATION;
        $is_volunteer   = $user->user_type_id == UserType::USER_TYPE_VOLUNTEER;

        $show_direction    = $this->additional['show_direction'] ?? false;
        $show_associations = $this->additional['show_associations'] ?? true;

        return [
            'id'                => $user->id,
            'email'             => $this->when(!$this->resume, $user->email),
            'phone'             => $this->when(!$this->resume, $user->phone),
            'name'              => $user->name,
            'user_type_id'      => new UserTypeResource($user->type), //legacy
            'user_type'         => new UserTypeResource($user->type),
            'corporate_name'    => $this->when($is_association, $user->corporate_name),
            'cif'               => $this->when($is_association, $user->cif),
            'address'           => $this->when($user->id == \Auth::id() || $show_direction, $user->address),
            'city'              => $user->city,
            'state'             => $user->state,
            'zip_code'          => $user->zip_code,
            'nearby_areas_id'   => $this->when(!$this->resume && $is_volunteer, //legacy
                                               $user->nearbyAreas
                                                   ? new NearbyAreasResource($user->nearbyAreas)
                                                   : 99),
            'nearby_areas'      => $this->when(!$this->resume && $is_volunteer,
                                               $user->nearbyAreas
                                                   ? new NearbyAreasResource($user->nearbyAreas)
                                                   : 99),
            'activity_areas_id' => $this->when($is_association, new ActivityAreasResource($user->activityAreas)), //legacy
            'activity_areas'    => $this->when($is_association, new ActivityAreasResource($user->activityAreas)),
            'user_status_id'    => $this->when($user->id == \Auth::id(), new UserStatusResource($user->status)), //legacy
            'user_status'       => $this->when($user->id == \Auth::id(), new UserStatusResource($user->status)),
            'associations'      => $this->when(!$this->resume && $show_associations,
                                               new UserCollection($user->associations)),
        ];
    }
}
