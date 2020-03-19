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
     * @return array
     */
    public function toArray($request) {
        $this->collection->transform(function (User $user) {
            return (new UserResource($user, $this->resume))->additional($this->additional);
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
