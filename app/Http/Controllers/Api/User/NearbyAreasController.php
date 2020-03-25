<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 25/03/2020
 * Time: 13:53
 */

namespace App\Http\Controllers\Api\User;


use App\Http\Controllers\Api\ApiController;
use App\Models\User\NearbyAreas;
use App\Resources\User\NearbyAreasCollection;

class NearbyAreasController extends ApiController {

    /**
     * List of all user types.
     *
     * @return NearbyAreasCollection
     */
    public function list() {
        return new NearbyAreasCollection(NearbyAreas::all());
    }
}
