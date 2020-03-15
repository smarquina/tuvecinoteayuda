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
    $api->get('register', 'UserController@register');
    $api->get('login', 'UserController@login');

    $api->get('user-types/', 'UserTypeController@index');
    $api->get('help-request-types/', 'HelpRequestTypeController@index');

    $api->get('help-requests/', 'HelpRequestController@index');
    $api->get('help-requests/post', 'HelpRequestController@post');
    $api->get('help-requests/accept', 'HelpRequestController@accept');
});
