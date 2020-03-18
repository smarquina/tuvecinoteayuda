<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 17/03/2020
 * Time: 22:00
 */

namespace App\Resources\User;


use App\Models\User\User;
use App\Resources\ApiCollection;

class UserCollection extends ApiCollection {

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request) {

        if ($this->resume) {
            $this->collection->transform(
                function (User $user) {
                    return (new UserResource($user, $this->resume))->additional($this->additional);
                });

            return parent::toArray($request);
        } else {
            return UserResource::collection($this->collection)->additional(['resume' => $this->resume]);
        }
    }
}
