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


// URL referència: auth0.com/blog/developing-restful-apis-with-lumen/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    // api/login
    $router->get('login', [ 'uses' => 'LoginController@verificarToken' ]);
    $router->post('login', [ 'uses' => 'LoginController@login' ]);
    $router->get('getStudents', [ 'uses' => 'LoginController@getStudents' ]);
}
);
