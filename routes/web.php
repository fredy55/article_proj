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
*/

$router->get('/', function() {
    return view('home');
});

// ============ ARTICLES ENDPOINT  ===================//
$router->group(['prefix' => 'api/v1'], function()use ($router) {
    $router->get('/articles',  'ArticlesController@allArticles'); //Url article directory
    $router->get('/articles/{id}',  'ArticlesController@singleArticle'); //Url article full text
    $router->post('/articles/{id}/comment',  'ArticlesController@articleComments'); //Url article comment
    $router->get('/articles/{id}/like',  'ArticlesController@articleLikes'); //Url article like
    $router->get('/articles/{id}/view',  'ArticlesController@articleViews'); //Url article views
});
