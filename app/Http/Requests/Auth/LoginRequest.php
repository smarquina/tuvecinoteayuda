<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/03/2020
 * Time: 13:08
 */

namespace App\Http\Requests\Auth;


use App\Http\Requests\ApiRequest;

class LoginRequest extends ApiRequest {
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
        return [
            'user'     => 'required|max:50|string', //regex:/[0-9]{9}/
            'password' => 'required|max:100',
        ];
    }
}
