<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 25/03/2020
 * Time: 13:59
 */

namespace App\Http\Controllers\Api\User;


use App\Http\Controllers\Api\ApiController;
use App\Models\User\ActivityAreas;
use App\Resources\User\ActivityAreasCollection;

class ActivityAreasController extends ApiController {

    /**
     * List of all user types.
     *
     * @return ActivityAreasCollection
     */
    public function list() {
        return new ActivityAreasCollection(ActivityAreas::all());
    }
}
