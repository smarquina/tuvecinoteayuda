<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 16/03/2020
 * Time: 2:44
 */

namespace App\Resources\User;


use App\Models\User\UserStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class UserStatusResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @OA\Schema(schema="UserStatusResource", type="object")
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        /** @var UserStatus $userStatus */
        $userStatus = clone $this;

        return [
            'id'   => $userStatus->id,
            'name' => $userStatus->name,
        ];
    }
}
