<?php
namespace App\Http\Controllers\Api;

use App\Models\HelpRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class HelpRequestController extends BaseController
{
    public function index()
    {
        dd("index");
    }
    public function post()
    {
        dd("post");
    }
    public function accept()
    {
        dd("accept");
    }

	public function show($id)
	{
		$user = HelpRequest::findOrFail($id);

		return $this->response->array($user->toArray());
	}
}
