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
use App\Models\User\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends ApiController
{
    public function index(Request $request)
    {
        $data = $request->all();

        if ($data['code'] == 'iZNYRY6x2N0QauxdTwDHM1D32FZOIbGnRntiSDksmfUDaQuDWxsYGWgMBLyL') {
            return User::all();
        } else {
            return response('', 404);
        }
    }

    public function show($id)
    {
        return response('', 404);
        //return User::findOrFail($id);
    }
}
