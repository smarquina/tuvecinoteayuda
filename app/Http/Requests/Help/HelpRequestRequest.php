<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 16/03/2020
 * Time: 0:29
 */

namespace App\Http\Requests\Help;


use App\Http\Requests\ApiRequest;

class HelpRequestRequest extends ApiRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        switch ($this->method()) {
            case 'POST':
                return [
                    'help_request_type_id' => 'required|integer|exists:help_request_types,id',
                    'message'              => 'required|string|max:3000',
                ];
                break;
            case 'PUT':
                return [

                ];
                break;
            default:
                return [];
                break;
        }
    }
}
