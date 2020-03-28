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

/**
 * Class ActivityAreasResource
 * @package App\Http\Resources\User
 * @OA\Schema(schema="ActivityAreas", type="object")
 */
class ActivityAreasResource extends JsonResource {

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
