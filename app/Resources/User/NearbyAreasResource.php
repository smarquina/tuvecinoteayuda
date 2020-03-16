<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 16/03/2020
 * Time: 2:44
 */

namespace App\Resources\User;


use App\Models\User\NearbyAreas;
use Illuminate\Http\Resources\Json\JsonResource;

class NearbyAreasResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @OA\Schema(schema="NearbyAreasResource", type="object")
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        /** @var NearbyAreas $nearbyAreas */
        $nearbyAreas = clone $this;

        return [
            'id'   => $nearbyAreas->id,
            'name' => $nearbyAreas->name,
        ];
    }
}
