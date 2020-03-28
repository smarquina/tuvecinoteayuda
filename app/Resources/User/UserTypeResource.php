<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 16/03/2020
 * Time: 2:44
 */

namespace App\Resources\User;


use App\Models\User\UserType;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserTypeResource
 * @package App\Http\Resources\User
 * @OA\Schema(schema="UserType", type="object")
 */
class UserTypeResource extends JsonResource {

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
