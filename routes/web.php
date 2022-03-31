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

•	Url article directory: /articles
•	Url article page: /articles/{id}
•	Url article comment: /articles/{id}/comment
•	Url article like: /articles/{id}/like
•	Url article views: /articles/{id}/view

|
*/

$router->get('/', function() {
    return view('home');
});


$router->group(['prefix' => 'api/v1'], function()use ($router) {
    $router->get('users',  'Api\V1\UserController@index');
    $router->get('users/{userid}', ['uses' => 'Api\V1\UserController@show']);
    $router->post('users/create', ['uses' => 'Api\V1\UserController@store']);
    $router->post('users/update', ['uses' => 'Api\V1\UserController@update']);
    $router->get('users/delete/{userid}', ['uses' => 'Api\V1\UserController@destroy']);
});
