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
use App\Models\User;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends ApiController
{
    public function index() {
        dd("index");
    }

    public function show($id) {
        return User::findOrFail($id);
    }
}
