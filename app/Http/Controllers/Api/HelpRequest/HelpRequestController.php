<?php
/**
 * Created for tuvecinoteayuda.
 * User: Luis David de la Fuente Rodriguez
 * Email: ddelafuente@nesiweb.com
 * Date: 14/03/2020
 * Time: 23:30
 */

namespace App\Http\Controllers\Api\HelpRequest;

use App\Http\Controllers\Api\ApiController;
use App\Models\HelpRequest;
use App\Models\UserType;
use Auth;
use Illuminate\Http\Request;

class HelpRequestController extends ApiController
{
    public function index()
    {
        $user = Auth::user();

        switch ($user->user_type) {
            case UserType::USER_TYPE_REQUESTER:
                return HelpRequest::where('user_id', '=', Auth::id())->get();

            case UserType::USER_TYPE_VOLUNTEER:
                return HelpRequest::where('assigned_user_id')->where('city', '=', $user->city)->get();

            default:
                return response('Tipo de usuario no definido', 400);
        }
    }

    public function post(Request $request)
    {
        request()->validate([
            'help_request_type' => 'required',
            'message' => 'required',
        ]);

        $data = $request->all();

        $check = HelpRequest::create([
            'user_id' => Auth::id(),
            'help_request_type' => $data['help_request_type'],
            'message' => $data['message'],
        ]);

        if ($check) {
            return response('', 200);
        } else {
            return response('Error al insertar', 400);
        }
    }

    public function put(Request $request)
    {
        $user = Auth::user();

        if ($user->user_type != UserType::USER_TYPE_VOLUNTEER) {
            return response('Tipo de usuario no autorizado para esta acción', 403);
        }

        request()->validate([
            'help_request_id' => 'required',
        ]);

        $data = $request->all();

        $help_request = HelpRequest::find($data['help_request_id']);

        if (!empty($help_request->assigned_user_id)) {
            return response('Petición ya atendida con anterioridad', 400);
        }

        $help_request->assigned_user_id = Auth::id();
        $help_request->accepted_at = time();

        if ($help_request->save()) {
            return response('', 200);
        } else {
            return response('Error al actualizar', 400);
        }
    }
}
