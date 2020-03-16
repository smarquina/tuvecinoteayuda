<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 15/03/2020
 * Time: 12:51
 */

namespace App\Http\Requests\User;


use App\Http\Requests\ApiRequest;

class UserRequest extends ApiRequest {

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
                    'name'                  => 'nullable|string|max:150',
                    'phone'                 => 'required|max:20|unique:users,phone',
                    'email'                 => 'required|email|max:45|unique:users,email',
                    'user_type_id'          => 'required|int|exists:user_types,id',
                    'nearby_areas_id'       => 'nullable|exists:nearby_areas,id',
                    'password'              => 'required|max:20|min:8|confirmed',
                    'password_confirmation' => 'required|max:20',
                    'address'               => 'required|string|max:191',
                    'city'                  => 'required|string',
                    'zip_code'              => 'required|string|max:5',
                ];
                break;
            case 'PUT':
                return [
                    'name'  => 'required|string|max:150',
                    'email' => 'required|email|max:45|unique:users,email,' . \Auth::id(),
                    'phone' => 'required|max:20|unique:users,phone,' . \Auth::id(),
                ];
                break;
            default:
                return [];
                break;
        }
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() {
        return [
            'name'                  => trans('general.attributes.name'),
            'phone'                 => trans('general.attributes.phone'),
            'email'                 => trans('general.attributes.email'),
            'user_type_id'          => "Tipo de usuario",
            'nearby_areas_id'       => "Zonas",
            'password'              => trans('general.attributes.password'),
            'password_confirmation' => "Confirmación de contraseña",
            'address'               => trans('general.attributes.address'),
            'city'                  => trans('general.attributes.city'),
            'zip_code'              => trans('general.attributes.zip_code'),
        ];
    }
}
