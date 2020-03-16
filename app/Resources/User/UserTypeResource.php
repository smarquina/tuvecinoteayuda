<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 16/03/2020
 * Time: 2:44
 */

namespace App\Resources\User;


use App\Models\UserType;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTypeResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @OA\Schema(schema="UserTypeResource", type="object")
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        /** @var UserType $userType */
        $userType = clone $this;

        return [
            'id'   => $userType->id,
            'name' => $userType->name,
        ];
    }
}
