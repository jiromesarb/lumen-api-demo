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
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/sample', function(){
        $person = [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];

        return ($person);
    });


    $router->post('user/register','AuthController@register');

    $router->post('user/login', 'AuthController@login');
    $router->group(['middleware' => ['auth']], function () use ($router){

        $router->post('token/destroy', 'AuthController@logout');
        $router->get('user/search', 'AuthController@search');
    });


});
