<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 16/03/2020
 * Time: 2:45
 */

namespace App\Resources\User;


use Illuminate\Http\Resources\Json\ResourceCollection;

class UserTypeCollection extends ResourceCollection {

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request) {
        return UserTypeResource::collection($this->collection);
    }
}
