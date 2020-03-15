<?php

namespace App\Http\Controllers\Api;

use App\Models\HelpRequestType;

class HelpRequestTypeController extends ApiController {
    public function index() {
        return HelpRequestType::all();
    }
}
