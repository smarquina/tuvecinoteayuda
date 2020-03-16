<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 14/03/2020
 * Time: 23:30
 */

namespace App\Http\Controllers\Api\HelpRequest;

use App\Http\Controllers\Api\ApiController;
use App\Models\HelpRequestType;
use App\Resources\HelpRequest\HelpRequestTypeCollection;

class HelpRequestTypeController extends ApiController {

    /**
     * List of all request types.
     *
     * @return HelpRequestTypeCollection
     */
    public function list() {
        return new HelpRequestTypeCollection(HelpRequestType::all());
    }
}
