<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 15/03/2020
 * Time: 12:00
 */

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;



use Illuminate\Http\Request;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;


/**
 * Class AuthController
 * @package App\Http\Controllers\Api
 */
class AuthController extends ApiController
{
    public function register(Request $request)
    {
        request()->validate([
            'name'                  => 'required|string|max:191',
            'email'                 => 'required|email|max:191|unique:users,email',
            'phone'                 => 'required|max:20|unique:users',
            'password'              => 'required|max:20|min:8|confirmed',
            'password_confirmation' => 'required|max:20',
            'user_type'             => 'required|int',
            'address'               => 'required|string|max:191',
            'city'                  => 'required|int',
            'state'                 => 'required|int',
            'zip_code'              => 'required|string|max:5',
            'especially_vulnerable' => 'nullable|boolean',
            'nearby_areas'          => 'nullable|boolean',
        ]);

        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'user_type' => $data['user_type'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip_code'],
            'especially_vulnerable' => $data['especially_vulnerable'] ?? null,
            'nearby_areas' => $data['nearby_areas'] ?? null,
        ]);

        $token = \JWTAuth::fromUser($user);

        if ($token) {
            return response(['token' => $token], 200);
        } else {
            return response('', 400);
        }
    }

    public function login(Request $request)
    {
        request()->validate([
            'phone'     => 'required',
            'password'  => 'required',
        ]);

        $credentials = $request->only('phone', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = \JWTAuth::fromUser($user);
            return response(['token' => $token], 200);
        } else {
            return response('', 403);
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return response('', 200);
    }
}
