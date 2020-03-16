<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 16/03/2020
 * Time: 2:54
 */

namespace App\Resources\HelpRequest;


use Illuminate\Http\Resources\Json\ResourceCollection;

class HelpRequestTypeCollection extends ResourceCollection {

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request) {
        return HelpRequestTypeResource::collection($this->collection);
    }
}
