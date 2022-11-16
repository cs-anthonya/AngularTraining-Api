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

$router->group([
    'prefix' => 'auth'

], function ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->post('me', 'AuthController@me');

});


$router->group([
    'middleware' => 'auth',
    'prefix' => 'v1'

], function ($router) {
    $router->post('create', 'TaskController@addTask');
    $router->post('update/{id}', 'TaskController@updateTask');
    $router->delete('delete/{id}', 'TaskController@delete');
    $router->get('getall', 'TaskController@getall');
    $router->put('changeStatus/{id}/{status}', 'TaskController@changeStatus');
    $router->get('get/{id}', 'TaskController@get');
});


$router->get('/', function () use ($router) {
    return $router->app->version();
});
