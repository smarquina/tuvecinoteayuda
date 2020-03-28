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

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Tu vecino te ayuda API",
 *         description="This is a Beta version of tuvecinoteayuda api. Use it carefully and report all bugs and security problems found.",
 *         termsOfService="https://tuvecinoteayuda.org/politica_privacidad.pdf",
 *         @OA\Contact(
 *             email="hablamos@tuvecinoteayuda.org"
 *         ),
 *         @OA\License(
 *             name="Apache 2.0",
 *             url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *         )
 *     ),
 *     @OA\Server(
 *         description="Tu vecino te Ayuda OpenApi host",
 *         url="https://www.api.tuvecinoteayuda.org/"
 *     ),
 *     @OA\Tag(name="user"),
 *     @OA\Tag(name="helpRequest", description="handle all help request and volunteers help"),
 * )
 *
 * @SWG\Swagger(
 *     basePath="/api",
 *     schemes={"https"}
 *     @SWG\Info(
 *         version="1.0.0"
 *     )
 * )
 */
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
