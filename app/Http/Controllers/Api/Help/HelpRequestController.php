<?php

namespace App\Http\Controllers\Api;

use App\Models\HelpRequest;

class HelpRequestController extends ApiController {
    public function index() {
        dd("index");
    }

    public function post() {
        dd("post");
    }

    public function accept() {
        dd("accept");
    }

    public function show($id) {
        $user = HelpRequest::findOrFail($id);

        return $this->response->array($user->toArray());
    }
}
