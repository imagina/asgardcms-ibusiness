<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/ibusiness'], function (Router $router) {
    $router->bind('business', function ($id) {
        return app('Modules\Ibusiness\Repositories\BusinessRepository')->find($id);
    });
    $router->get('businesses', [
        'as' => 'admin.ibusiness.business.index',
        'uses' => 'BusinessController@index',
        'middleware' => 'can:ibusiness.businesses.index'
    ]);
    $router->get('businesses/create', [
        'as' => 'admin.ibusiness.business.create',
        'uses' => 'BusinessController@create',
        'middleware' => 'can:ibusiness.businesses.create'
    ]);
    $router->post('businesses', [
        'as' => 'admin.ibusiness.business.store',
        'uses' => 'BusinessController@store',
        'middleware' => 'can:ibusiness.businesses.create'
    ]);
    $router->get('businesses/{business}/edit', [
        'as' => 'admin.ibusiness.business.edit',
        'uses' => 'BusinessController@edit',
        'middleware' => 'can:ibusiness.businesses.edit'
    ]);
    $router->put('businesses/{business}', [
        'as' => 'admin.ibusiness.business.update',
        'uses' => 'BusinessController@update',
        'middleware' => 'can:ibusiness.businesses.edit'
    ]);
    $router->delete('businesses/{business}', [
        'as' => 'admin.ibusiness.business.destroy',
        'uses' => 'BusinessController@destroy',
        'middleware' => 'can:ibusiness.businesses.destroy'
    ]);


    $router->bind('userbusiness', function ($id) {
        return app('Modules\Ibusiness\Repositories\userbusinessRepository')->find($id);
    });
    $router->get('userbusinesses', [
        'as' => 'admin.ibusiness.userbusiness.index',
        'uses' => 'userbusinessController@index',
        'middleware' => 'can:ibusiness.userbusinesses.index'
    ]);
    $router->get('userbusinesses/create', [
        'as' => 'admin.ibusiness.userbusiness.create',
        'uses' => 'userbusinessController@create',
        'middleware' => 'can:ibusiness.userbusinesses.create'
    ]);
    $router->post('userbusinesses', [
        'as' => 'admin.ibusiness.userbusiness.store',
        'uses' => 'userbusinessController@store',
        'middleware' => 'can:ibusiness.userbusinesses.create'
    ]);
    $router->get('userbusinesses/{userbusiness}/edit', [
        'as' => 'admin.ibusiness.userbusiness.edit',
        'uses' => 'userbusinessController@edit',
        'middleware' => 'can:ibusiness.userbusinesses.edit'
    ]);
    $router->put('userbusinesses/{userbusiness}', [
        'as' => 'admin.ibusiness.userbusiness.update',
        'uses' => 'userbusinessController@update',
        'middleware' => 'can:ibusiness.userbusinesses.edit'
    ]);
    $router->delete('userbusinesses/{userbusiness}', [
        'as' => 'admin.ibusiness.userbusiness.destroy',
        'uses' => 'userbusinessController@destroy',
        'middleware' => 'can:ibusiness.userbusinesses.destroy'
    ]);
    $router->get('getbranch/{business_id}', [
      'as' => 'admin.ibusiness.userbusiness.getbranchoffice',
      'uses' => 'userbusinessController@getBranchOffice',
      'middleware' => 'can:ibusiness.userbusinesses.create'
    ]);


    $router->bind('orderapprovers', function ($id) {
        return app('Modules\Ibusiness\Repositories\orderApproversRepository')->find($id);
    });
    $router->get('orderapprovers', [
        'as' => 'admin.ibusiness.orderapprovers.index',
        'uses' => 'orderApproversController@index',
        'middleware' => 'can:ibusiness.orderapprovers.index'
    ]);
    $router->get('orderapprovers/create', [
        'as' => 'admin.ibusiness.orderapprovers.create',
        'uses' => 'orderApproversController@create',
        'middleware' => 'can:ibusiness.orderapprovers.create'
    ]);
    $router->post('orderapprovers', [
        'as' => 'admin.ibusiness.orderapprovers.store',
        'uses' => 'orderApproversController@store',
        'middleware' => 'can:ibusiness.orderapprovers.create'
    ]);
    $router->get('orderapprovers/{orderapprovers}/edit', [
        'as' => 'admin.ibusiness.orderapprovers.edit',
        'uses' => 'orderApproversController@edit',
        'middleware' => 'can:ibusiness.orderapprovers.edit'
    ]);
    $router->put('orderapprovers/{orderapprovers}', [
        'as' => 'admin.ibusiness.orderapprovers.update',
        'uses' => 'orderApproversController@update',
        'middleware' => 'can:ibusiness.orderapprovers.edit'
    ]);
    $router->delete('orderapprovers/{orderapprovers}', [
        'as' => 'admin.ibusiness.orderapprovers.destroy',
        'uses' => 'orderApproversController@destroy',
        'middleware' => 'can:ibusiness.orderapprovers.destroy'
    ]);


    $router->bind('businessproduct', function ($id) {
        return app('Modules\Ibusiness\Repositories\businessproductRepository')->find($id);
    });
    $router->get('businessproducts', [
        'as' => 'admin.ibusiness.businessproduct.index',
        'uses' => 'businessproductController@index',
        'middleware' => 'can:ibusiness.businessproducts.index'
    ]);
    $router->get('businessproducts/create', [
        'as' => 'admin.ibusiness.businessproduct.create',
        'uses' => 'businessproductController@create',
        'middleware' => 'can:ibusiness.businessproducts.create'
    ]);
    $router->post('businessproducts', [
        'as' => 'admin.ibusiness.businessproduct.store',
        'uses' => 'businessproductController@store',
        'middleware' => 'can:ibusiness.businessproducts.create'
    ]);
    $router->get('businessproducts/{businessproduct}/edit', [
        'as' => 'admin.ibusiness.businessproduct.edit',
        'uses' => 'businessproductController@edit',
        'middleware' => 'can:ibusiness.businessproducts.edit'
    ]);
    $router->put('businessproducts/{businessproduct}', [
        'as' => 'admin.ibusiness.businessproduct.update',
        'uses' => 'businessproductController@update',
        'middleware' => 'can:ibusiness.businessproducts.edit'
    ]);
    $router->delete('businessproducts/{businessproduct}', [
        'as' => 'admin.ibusiness.businessproduct.destroy',
        'uses' => 'businessproductController@destroy',
        'middleware' => 'can:ibusiness.businessproducts.destroy'
    ]);
// append







});
