<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/03/2020
 * Time: 23:49
 */

namespace App\Resources\User;


use App\Models\User\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {


    /**
     * Transform the resource into an array.
     *
     * @OA\Schema(schema="UserResource", type="object")
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        /** @var User $user */
        $user = clone $this;

        return [
            'id'             => $user->id,
            'email'          => $user->email,
            'name'           => $user->name,
            'phone'          => $user->phone,
            'address'        => $this->when($user->id == \Auth::id(), $user->address),
            'city'           => $this->when($user->id == \Auth::id(), $user->city),
            'state'          => $this->when($user->id == \Auth::id(), $user->state),
            'zip_code'       => $this->when($user->id == \Auth::id(), $user->zip_code),
            'nearby_areas'   => new NearbyAreasResource($user->nearbyAreas),
            'user_status_id' => $this->when($user->id == \Auth::id(), new UserStatusResource($user->status)),
        ];
    }
}
