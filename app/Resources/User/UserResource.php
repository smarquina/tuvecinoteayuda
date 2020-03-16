<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/03/2020
 * Time: 23:49
 */

namespace App\Resources\User;


use App\Models\User;
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
        ];
    }
}