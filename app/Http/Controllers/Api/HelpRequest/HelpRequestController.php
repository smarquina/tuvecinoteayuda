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
use Illuminate\Http\Request;
use Auth;
use Validator;

class HelpRequestController extends ApiController
{
    public function index()
    {
        $user = Auth::user();

        switch ($user->user_type) {
            case UserType::USER_TYPE_REQUESTER:
                return HelpRequest::where('user_id', '=', Auth::id());

            case UserType::USER_TYPE_VOLUNTEER:
                return HelpRequest::whereNull('assigned_user_id');

            default:
                return response('', 400);
        }
    }

    public function put(Request $request)
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
            return response('', 400);
        }
    }

    public function post(Request $request)
    {
        request()->validate([
            'help_request_id' => 'required',
        ]);

        $data = $request->all();

        $help_request = HelpRequest::find($data['help_request_id']);
        $help_request->assigned_user_id = Auth::id();
        $help_request->accepted_at = time();

        if ($help_request->save()) {
            return response('', 200);
        } else {
            return response('', 400);
        }
    }
}
