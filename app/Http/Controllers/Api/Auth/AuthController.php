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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $data = $request->all();

        $check = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return response('', 200);
    }

    public function login(Request $request)
    {
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return response('', 200);
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
