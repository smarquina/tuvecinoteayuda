<?php

namespace App\Http\Controllers\Api;

use App\Models\UserType;

class UserTypeController extends ApiController {

    public function index() {
        return UserType::all();
    }
}
