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
    $router->bind('typebusiness', function ($id) {
        return app('Modules\Ibusiness\Repositories\TypeBusinessRepository')->find($id);
    });
    $router->get('typebusinesses', [
        'as' => 'admin.ibusiness.typebusiness.index',
        'uses' => 'TypeBusinessController@index',
        'middleware' => 'can:ibusiness.typebusinesses.index'
    ]);
    $router->get('typebusinesses/create', [
        'as' => 'admin.ibusiness.typebusiness.create',
        'uses' => 'TypeBusinessController@create',
        'middleware' => 'can:ibusiness.typebusinesses.create'
    ]);
    $router->post('typebusinesses', [
        'as' => 'admin.ibusiness.typebusiness.store',
        'uses' => 'TypeBusinessController@store',
        'middleware' => 'can:ibusiness.typebusinesses.create'
    ]);
    $router->get('typebusinesses/{typebusiness}/edit', [
        'as' => 'admin.ibusiness.typebusiness.edit',
        'uses' => 'TypeBusinessController@edit',
        'middleware' => 'can:ibusiness.typebusinesses.edit'
    ]);
    $router->put('typebusinesses/{typebusiness}', [
        'as' => 'admin.ibusiness.typebusiness.update',
        'uses' => 'TypeBusinessController@update',
        'middleware' => 'can:ibusiness.typebusinesses.edit'
    ]);
    $router->delete('typebusinesses/{typebusiness}', [
        'as' => 'admin.ibusiness.typebusiness.destroy',
        'uses' => 'TypeBusinessController@destroy',
        'middleware' => 'can:ibusiness.typebusinesses.destroy'
    ]);
    $router->bind('type', function ($id) {
        return app('Modules\Ibusiness\Repositories\TypeRepository')->find($id);
    });
    $router->get('types', [
        'as' => 'admin.ibusiness.type.index',
        'uses' => 'TypeController@index',
        'middleware' => 'can:ibusiness.types.index'
    ]);
    $router->get('types/create', [
        'as' => 'admin.ibusiness.type.create',
        'uses' => 'TypeController@create',
        'middleware' => 'can:ibusiness.types.create'
    ]);
    $router->post('types', [
        'as' => 'admin.ibusiness.type.store',
        'uses' => 'TypeController@store',
        'middleware' => 'can:ibusiness.types.create'
    ]);
    $router->get('types/{type}/edit', [
        'as' => 'admin.ibusiness.type.edit',
        'uses' => 'TypeController@edit',
        'middleware' => 'can:ibusiness.types.edit'
    ]);
    $router->put('types/{type}', [
        'as' => 'admin.ibusiness.type.update',
        'uses' => 'TypeController@update',
        'middleware' => 'can:ibusiness.types.edit'
    ]);
    $router->delete('types/{type}', [
        'as' => 'admin.ibusiness.type.destroy',
        'uses' => 'TypeController@destroy',
        'middleware' => 'can:ibusiness.types.destroy'
    ]);
// append




});
