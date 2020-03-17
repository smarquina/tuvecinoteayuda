<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 17/03/2020
 * Time: 22:00
 */

namespace App\Resources\User;


use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection {

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request) {
        return UserResource::collection($this->collection);
    }
}
