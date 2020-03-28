<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 20/03/2020
 * Time: 17:00
 */

namespace App\Http\Requests\Auth;


use App\Http\Requests\ApiRequest;

class VerificationRequest extends ApiRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'image' => 'required|string',
            'dni'   => 'required|string|min:9|max:9',
            'name'  => 'required|string|max:255',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() {
        return [
            'image' => trans('general.attributes.image'),
        ];
    }
}
