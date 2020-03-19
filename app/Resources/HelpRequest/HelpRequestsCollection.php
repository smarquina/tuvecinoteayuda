<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 16/03/2020
 * Time: 0:06
 */

namespace App\Resources\HelpRequest;


use App\Models\HelpRequest\HelpRequest;
use App\Resources\ApiCollection;

/**
 * Class HelpRequestsCollection
 * @package app\Resources\HelpRequest
 */
class HelpRequestsCollection extends ApiCollection {

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        $this->collection->transform(function (HelpRequest $helpRequest) {
            return (new HelpRequestResource($helpRequest, $this->resume))->additional($this->additional);
        });

        return parent::toArray($request);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request) {
        return [];
    }
}
