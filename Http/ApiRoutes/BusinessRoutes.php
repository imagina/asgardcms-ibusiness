<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/business'], function (Router $router) {

    $router->post('/', [
        'as' => 'api.icommerce.business.create',
        'uses' => 'BusinessApiController@create',
        // 'middleware' => ['auth:api']
    ]);
    $router->get('/', [
        'as' => 'api.icommerce.business.index',
        'uses' => 'BusinessApiController@index',
    ]);
    $router->get('/{criteria}', [
        'as' => 'api.icommerce.business.show',
        'uses' => 'BusinessApiController@show',
    ]);
    $router->put('/{criteria}', [
        'as' => 'api.icommerce.business.update',
        'uses' => 'BusinessApiController@update',
        'middleware' => ['auth:api']
    ]);
    $router->delete('/{criteria}', [
        'as' => 'api.icommerce.business.delete',
        'uses' => 'BusinessApiController@delete',
        'middleware' => ['auth:api']
    ]);

});
