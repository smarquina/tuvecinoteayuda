<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 25/03/2020
 * Time: 2:29
 */

namespace App\Http\Requests\Auth;


use App\Http\Requests\ApiRequest;

class ResetPasswordRequest extends ApiRequest {

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
            'token'                 => 'required',
            'email'                 => 'required|email|exists:user,email',
            'password'              => 'required|max:20|min:8|confirmed',
            'password_confirmation' => 'required|max:20',
        ];
    }
}
