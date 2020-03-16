<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 14/03/2020
 * Time: 23:30
 */

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Models\UserType;
use App\Resources\User\UserTypeCollection;

class UserTypeController extends ApiController {

    /**
     * List of all user types.
     *
     * @return UserTypeCollection
     */
    public function list() {
        return new UserTypeCollection(UserType::all());
    }
}
