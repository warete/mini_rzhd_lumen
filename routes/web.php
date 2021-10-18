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

$router->group(['middleware' => 'auth'], function ($router) {
    $router->get('/logout/', ['as' => 'logout', 'uses' => 'UserController@logout']);
    $router->get('/search/', ['as' => 'main', 'uses' => 'RouteController@index']);
    $router->get('/user/tickets/', ['as' => 'user_tickets', 'uses' => 'UserController@tickets']);
    $router->addRoute(['GET', 'POST'], '/route/{routeId}/buy-ticket/', ['as' => 'route.buy', 'uses' => 'RouteController@buyTicket']);
    $router->get('/admin/route/new/', ['as' => 'admin_route_new', 'uses' => 'AdminController@show']);
    $router->post('/admin/route/new/', ['as' => 'admin_route_new_store', 'uses' => 'AdminController@store']);
});

$router->get('/', ['as' => 'main_login', 'uses' => 'UserController@login']);
