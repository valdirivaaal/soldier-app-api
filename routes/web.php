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

$router->group(['prefix'=>'soldier'], function() use ($router){
    $router->post('insert', 'SoldierController@insert');

    $router->get('get', 'SoldierController@getData');
});

$router->group(['prefix'=>'device'], function() use ($router){
    $router->post('insert', 'DeviceController@insert');

    $router->get('get', 'DeviceController@getData');
});

$router->get('/dashboard', 'DashboardController@getData');

$router->group(['prefix'=>'dashboard'], function() use ($router){
    $router->post('insert', 'DashboardController@insert');

    $router->get('get', 'DashboardController@getData');
    $router->get('getById/{id_device}', 'DashboardController@getDataById');
    $router->get('getDataChartById/{id_device}', 'DashboardController@getDataChartById');
    $router->get('getDataMap', 'DashboardController@getDataMap');
});
