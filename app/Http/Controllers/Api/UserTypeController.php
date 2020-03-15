<?php
namespace App\Http\Controllers\Api;

use App\Models\UserType;
use Illuminate\Routing\Controller as BaseController;

class UserTypeController extends BaseController
{
    public function index()
    {
        return UserType::all();
    }
}
