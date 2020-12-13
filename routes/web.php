<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// $router->get('/example', [
//     'as' => 'example', 'uses' => 'ExampleController@index'
// ]);

$router->group([
    // 'namespace' => 'Example',
    'as' => 'examples',
], function () use ($router) {

    $router->get('/auth-code', [
        'as' => 'get_auth_code',
        'uses' => 'ExampleController@getAuthCode',
    ]);

    $router->get('/access-token', [
        'as' => 'get_access_token',
        'uses' => 'ExampleController@getAccessToken',
    ]);

    $router->get('/callback', [
        'as' => 'callback',
        'uses' => 'ExampleController@callback'
    ]);

    $router->get('/drive-list-files', [
        'as' => 'drive_list_files',
        'uses' => 'ExampleController@getDriveListFiles',
    ]);

    $router->get('/test', [
        'as' => 'test',
        'uses' => 'ExampleController@getAuthConfigFile',
    ]);
});
