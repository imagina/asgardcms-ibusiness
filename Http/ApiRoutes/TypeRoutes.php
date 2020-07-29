<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/type'], function (Router $router) {

    $router->post('/', [
        'as' => 'api.icommerce.type.create',
        'uses' => 'TypeApiController@create',
        // 'middleware' => ['auth:api']
    ]);
    $router->get('/', [
        'as' => 'api.icommerce.type.index',
        'uses' => 'TypeApiController@index',
    ]);
    $router->get('/{criteria}', [
        'as' => 'api.icommerce.type.show',
        'uses' => 'TypeApiController@show',
    ]);
    $router->put('/{criteria}', [
        'as' => 'api.icommerce.type.update',
        'uses' => 'TypeApiController@update',
        'middleware' => ['auth:api']
    ]);
    $router->delete('/{criteria}', [
        'as' => 'api.icommerce.type.delete',
        'uses' => 'TypeApiController@delete',
        'middleware' => ['auth:api']
    ]);

});
