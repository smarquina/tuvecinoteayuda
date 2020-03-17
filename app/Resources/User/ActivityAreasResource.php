<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 17/03/2020
 * Time: 19:48
 */

namespace App\Resources\User;


use App\Models\User\ActivityAreas;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityAreasResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @OA\Schema(schema="ActivityAreasResource", type="object")
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        /** @var ActivityAreas $activityAreas */
        $activityAreas = clone $this;

        return [
            'id'   => $activityAreas->id,
            'name' => $activityAreas->name,
        ];
    }
}
