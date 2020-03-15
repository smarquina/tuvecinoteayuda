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
use Auth;

class HelpRequestController extends ApiController
{
    public function index()
    {
        if (Auth::check()) {
            return HelpRequest::all();
        } else {
            return response('', 403);
        }
    }

    public function post()
    {
        if (Auth::check()) {
            dd("post");
            return HelpRequest::all();
        } else {
            return response('', 403);
        }
    }

    public function accept()
    {
        if (Auth::check()) {
            dd("post");
            return HelpRequest::all();
        } else {
            return response('', 403);
        }
    }

    public function show($id) {
        $user = HelpRequest::findOrFail($id);

        return $this->response->array($user->toArray());
    }
}
