<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$api = app('Dingo\Api\Routing\Router');

// $api->version('v1', ['namespace' => 'App\Http\Controllers\Api', 'middleware' => ['api']], function ($api) {
$api->version('v1', ['namespace' => 'App\Http\Controllers\Api'], function ($api) {
    $api->put('register', 'Auth\AuthController@register');
    $api->post('login', 'Auth\AuthController@login');
    $api->post('logout', 'Auth\AuthController@logout');

    $api->get('user-types/', 'User\UserTypeController@index');
    $api->get('help-request-types/', 'HelpRequest\HelpRequestTypeController@index');

    $api->get('help-requests/', 'HelpRequest\HelpRequestController@index');
    $api->put('help-requests/post', 'HelpRequest\HelpRequestController@post');
    $api->put('help-requests/accept', 'HelpRequest\HelpRequestController@accept');
});
