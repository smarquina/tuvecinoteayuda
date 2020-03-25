<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 25/03/2020
 * Time: 13:57
 */

namespace App\Resources\User;


use Illuminate\Http\Resources\Json\ResourceCollection;

class ActivityAreasCollection extends ResourceCollection {

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request) {
        return ActivityAreasResource::collection($this->collection);
    }
}
