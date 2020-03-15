<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function index()
    {
        dd("index");
    }

	public function show($id)
	{
		return User::findOrFail($id);
	}
}
