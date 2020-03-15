<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/03/2020
 * Time: 12:50
 */

namespace App\Http\Requests;


use Dingo\Api\Exception\ValidationHttpException;
use Dingo\Api\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ApiRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return \Auth::check();
    }

    protected function failedValidation(Validator $validator) {
        if ($this->ajax()) {
            throw new ValidationHttpException($validator->errors());

        } else {
            parent::failedValidation($validator);
        }
    }

}
