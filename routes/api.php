<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api', 'middleware' => ['api']], function ($api) {
    /** @var Dingo\Api\Routing\Router $api */

    // Public Routes
    $api->group(array('prefix' => 'public', 'as' => 'public'), function ($api) {

        $api->group(array('prefix' => 'auth', 'namespace' => 'Auth', 'as' => 'auth'), function ($api) {
            $api->post('register',  'AuthController@register')->name('register');
            $api->post('login',     'AuthController@login')->name('login');
        });

        $api->get('help-request-types', 'HelpRequest\HelpRequestTypeController@list');

        $api->group(array('namespace' => 'User'), function ($api) {
            $api->get('user-types',     'UserTypeController@list');
            $api->get('associations',   'UserController@associations');
        });
    });

    // Private routes
    $api->group(array('middleware' => ['jwt.auth']), function ($api) {
        $api->get('user-types', 'User\UserTypeController@index');

        $api->group(array('namespace' => 'HelpRequest'), function ($api) {
            $api->get('help-request-types', 'HelpRequestTypeController@index');

            $api->get('help-requests',  'HelpRequestController@list');
            $api->post('help-requests', 'HelpRequestController@store');
            $api->post('help-requests/accept/{id}', 'HelpRequestController@accept')->where('id', '[0-9]+');
            $api->get('help-requests/pending',      'HelpRequestController@pending');
        });

        $api->group(array('namespace' => 'User', 'as' => 'user', 'prefix' => 'user'), function ($api) {
            $api->get('profile',    'UserController@profile');
            $api->put('update',     'UserController@update');

            $api->group(['prefix' => 'association'], function ($api) {
                $api->post('join/{id}',      'UserController@joinAssociation')->where('id', '[0-9]+');
                $api->delete('detach/{id}',  'UserController@detachAssociation')->where('id', '[0-9]+');

            });
        });

    });

});
