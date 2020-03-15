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
                    'email'                 => 'required|email|max:45|unique:users,email',
                    'phone'                 => 'required|max:20|unique:users,phone',
                    'password'              => 'required|max:20|min:8|confirmed',
                    'password_confirmation' => 'required|max:20',
                    'user_type'             => 'required|int',
                    'address'               => 'required|string|max:191',
                    'city'                  => 'required|int',
                    'state'                 => 'required|int',
                    'zip_code'              => 'required|string|max:5',
                    'nearby_areas'          => 'nullable|boolean',
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
}
