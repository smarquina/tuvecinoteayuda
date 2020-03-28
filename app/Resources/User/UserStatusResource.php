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

/**
 * Class UserStatusResource
 * @package App\Http\Resources\User
 * @OA\Schema(schema="UserStatus", type="object")
 */
class UserStatusResource extends JsonResource {

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
     * Transform the resource into an array.
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
