<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/03/2020
 * Time: 2:30
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Enums\HttpErrors;
use Dingo\Api\Routing\Helpers;

class ApiController extends Controller {
    use Helpers;

    /**
     * @param int         $code
     * @param string|null $msg
     * @return \Illuminate\Http\JsonResponse
     */
    protected final function responseWithError(int $code, string $msg = null) {
        return response()->json(["message"     => $msg ?? HttpErrors::$messages[$code],
                                 "code"        => $code,
                                 "status_code" => $code,
                                 "status"      => HttpErrors::$messages[$code],
                                ], $code);
    }

    /**
     * @param string|null $msg
     * @return \Illuminate\Http\JsonResponse
     */
    protected final function responseOK(string $msg = null) {
        return response()->json(["message"     => empty($msg) ? 'OK' : $msg,
                                 "status_code" => HttpErrors::HTTP_OK,
                                 "status"      => HttpErrors::$messages[200],
                                ], HttpErrors::HTTP_OK);
    }
}
