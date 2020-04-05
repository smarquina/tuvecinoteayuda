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

/** @var \Dingo\Api\Routing\Router $api */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api', 'middleware' => ['api']], function ($api) {
    /** @var Dingo\Api\Routing\Router $api */

    // Public Routes
    $api->group(array('prefix' => 'public', 'as' => 'public'), function ($api) {

        $api->group(array('prefix' => 'auth', 'namespace' => 'Auth', 'as' => 'auth'), function ($api) {
            $api->post('register',              'AuthController@register')->name('register');
            $api->post('login',                 'AuthController@login')->name('login');
            $api->post('password/email',        'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
            $api->post('password/reset',        'ResetPasswordController@reset')->name('password.update');
        });

        $api->get('help-request-types', 'HelpRequest\HelpRequestTypeController@list');

        $api->group(array('namespace' => 'User'), function ($api) {
            $api->get('user-types',         'UserTypeController@list');
            $api->get('nearby-areas',       'NearbyAreasController@list');
            $api->get('activity-areas',     'ActivityAreasController@list');
            $api->get('associations',       'UserController@associations');
        });
    });

    // Private routes
    $api->group(array('middleware' => ['jwt.auth']), function ($api) {
        $api->get('user-types', 'User\UserTypeController@index');

        $api->group(array('namespace' => 'HelpRequest'), function ($api) {
            $api->get('help-request-types', 'HelpRequestTypeController@list');

            $api->get('help-requests',                              'HelpRequestController@list');
            $api->post('help-requests',                             'HelpRequestController@store');
            $api->delete('help-requests/{id}',                      'HelpRequestController@delete')->where('id', '[0-9]+');
            $api->post('help-requests/accept/{id}',                 'HelpRequestController@accept')->where('id', '[0-9]+');
            $api->post('help-requests/close/{id}',                  'HelpRequestController@close')->where('id', '[0-9]+');
            $api->delete('help-requests/revert/{id}',               'HelpRequestController@revert')->where('id', '[0-9]+');
            $api->get('help-requests/pending',                      'HelpRequestController@pending');
            $api->post('help-requests/track-external-call/{id}',    'HelpRequestController@trackExternalCall')->where('id', '[0-9]+');
        });

        $api->group(array('namespace' => 'User', 'as' => 'user', 'prefix' => 'user'), function ($api) {
            $api->get('profile',    'UserController@profile');
            $api->put('update',     'UserController@update');
            $api->get('associates', 'UserController@associates');

            $api->group(['prefix' => 'association'], function ($api) {
                $api->post('join/{id}',      'UserController@joinAssociation')->where('id', '[0-9]+');
                $api->delete('detach/{id}',  'UserController@detachAssociation')->where('id', '[0-9]+');
            });
        });

        $api->post('user/verify',                'Auth\AuthController@verifyUserData');
        $api->post('user/verification/resend',   'Auth\AuthController@resendVerificationEmail')->name('verification.resend');
    });

});
