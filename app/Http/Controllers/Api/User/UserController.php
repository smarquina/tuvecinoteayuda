<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends ApiController {
    public function index() {
        dd("index");
    }

    public function show($id) {
        return User::findOrFail($id);
    }
}
