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
use App\Models\User\UserType;

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

        $rules = [
            'nearby_areas_id'   => 'required_if:user_type_id,'. UserType::USER_TYPE_ASSOCIATION .'|exists:nearby_areas,id',
            'activity_areas_id' => 'nullable|exists:nearby_areas,id',
            'address'           => 'required|string|max:191',
            'city'              => 'required|string|max:20',
            'state'             => 'required|string|max:20',
            'zip_code'          => 'required|string|max:5',
        ];

        switch ($this->method()) {
            case 'POST':
                return array_merge($rules, [
                    'name'                  => 'required|string|max:150',
                    'phone'                 => 'required|max:9|min:8|string|unique:users,phone',
                    'email'                 => 'required|email|max:45|unique:users,email',
                    'password'              => 'required|max:20|min:8|confirmed',
                    'password_confirmation' => 'required|max:20',
                    'user_type_id'          => 'required|int|exists:user_types,id',
                    'corporate_name'        => 'string|max:150',
                    'cif'                   => 'string|max:5|min:5',
                ]);
                break;
            case 'PUT':
                return array_merge($rules, [
//                    'email' => 'required|email|max:45|unique:users,email,' . \Auth::id(),
//                    'phone' => 'required|max:20|unique:users,phone,' . \Auth::id(),
                ]);
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
            'user_type_id'          => trans('user.attributes.user_type_id'),
            'nearby_areas_id'       => trans('user.attributes.nearby_areas_id'),
            'password'              => trans('general.attributes.password'),
            'password_confirmation' => trans('user.attributes.password_confirmation'),
            'address'               => trans('general.attributes.address'),
            'city'                  => trans('general.attributes.city'),
            'zip_code'              => trans('general.attributes.zip_code'),
        ];
    }
}
