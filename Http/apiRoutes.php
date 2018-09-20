<?php

use Illuminate\Routing\Router;


$router->group(['prefix' => 'ibusiness'], function (Router $router) {


    $router->group(['prefix' => 'preorders'], function (Router $router) {

        $router->bind('preorder', function ($id) {
            return app(\Modules\Icommerce\Repositories\OrderRepository::class)->find($id);
        });

        $router->get('/', [
            'as' => 'ibusiness.api.preorders',
            'uses' => 'PreorderController@preorders',
        ]);

        $router->get('{preorder}', [
            'as' => 'ibusiness.api.preorder',
            'uses' => 'PreorderController@preorder',
        ]);

    });

    $router->group(['prefix' => 'products'], function (Router $router) {

        $router->post('/', [
            'as' => 'ibusiness.api.products.businessproducts',
            'uses' => 'ProductController@Product',
        ]);

    });

    $router->group(['prefix' => 'orderapprovers'], function (Router $router) {

        $router->get('status', [
            'as' => 'ibusiness.api.orderapprovers.getStatus',
            'uses' => 'OrderApproversController@getStatus',
        ]);

        $router->get('{orderID}', [
            'as' => 'ibusiness.api.orderapprovers.getDataApprover',
            'uses' => 'OrderApproversController@getDataApprover',
        ]);

        $router->put('/', [
            'as' => 'ibusiness.api.orderapprovers.update',
            'uses' => 'OrderApproversController@update',
        ]);

    });



});
