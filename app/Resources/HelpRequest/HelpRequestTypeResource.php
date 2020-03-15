<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/03/2020
 * Time: 23:58
 */

namespace app\Resources\HelpRequest;


use App\Models\HelpRequestType;
use Illuminate\Http\Resources\Json\JsonResource;

class HelpRequestTypeResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @OA\Schema(schema="UserResource", type="object")
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        /** @var HelpRequestType $helpRequestType */
        $helpRequestType = clone $this;


        return [
            'id'   => $helpRequestType->id,
            'name' => $helpRequestType->name,
        ];
    }
}
