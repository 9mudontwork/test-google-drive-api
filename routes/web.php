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

    $router->get('/access-token', [
        'as' => 'access_token',
        'uses' => 'ExampleController@getAccessTokens',
    ]);

    $router->get('/callback', [
        'as' => 'callback',
        'uses' => 'ExampleController@callback'
    ]);

    $router->get('/test', [
        'as' => 'test',
        'uses' => 'ExampleController@getAuthConfigFile',
    ]);
});
