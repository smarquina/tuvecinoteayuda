<?php
namespace App\Http\Controllers\Api;

use App\Models\HelpRequestType;
use Illuminate\Routing\Controller as BaseController;

class HelpRequestTypeController extends BaseController
{
    public function index()
    {
        return HelpRequestType::all();
    }
}
