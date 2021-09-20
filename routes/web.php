<?php

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

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');

$router->post('/soldier', 'SoldierController@insert');
$router->get('/soldier', 'SoldierController@getData');

$router->post('/device', 'DeviceController@insert');
$router->get('/device', 'DeviceController@getData');

$router->post('/dashboard', 'DashboardController@insert');
$router->get('/dashboard', 'DashboardController@getData');
$router->get('/dashboard/{id}', 'DashboardController@getDataById');
$router->get('/dashboard/chart/{id}', 'DashboardController@getDataChartById');
$router->get('/dashboard/map', 'DashboardController@getDataMap');

