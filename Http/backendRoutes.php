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
    $router->get('businesses/branchoffice/create/{business_id}', [
        'as' => 'admin.ibusiness.business.create.branchoffice',
        'uses' => 'BusinessController@createBranchOffice',
        'middleware' => 'can:ibusiness.businesses.create'
    ]);
    $router->post('businesses', [
        'as' => 'admin.ibusiness.business.store',
        'uses' => 'BusinessController@store',
        'middleware' => 'can:ibusiness.businesses.create'
    ]);
    $router->post('businesses/branchoffice', [
        'as' => 'admin.ibusiness.business.storebranchoffice',
        'uses' => 'BusinessController@storeBranchOffice',
        'middleware' => 'can:ibusiness.businesses.create'
    ]);
    $router->post('businesses/createaddress', [
        'as' => 'admin.ibusiness.business.createaddress',
        'uses' => 'BusinessController@storeAddress',
        'middleware' => 'can:ibusiness.businesses.create'
    ]);//parameters: address:array(),business_id: int
    $router->post('businesses/deleteaddress', [
        'as' => 'admin.ibusiness.business.deleteaddress',
        'uses' => 'BusinessController@deleteAddress',
        'middleware' => 'can:ibusiness.businesses.create'
    ]);//parameters: address_id int
    $router->post('businesses/setaddress', [
        'as' => 'admin.ibusiness.business.setaddress',
        'uses' => 'BusinessController@setAddress',
        'middleware' => 'can:ibusiness.businesses.create'
    ]);//parameters: address_id int
    $router->post('businesses/updateaddress', [
        'as' => 'admin.ibusiness.business.updateAddress',
        'uses' => 'BusinessController@updateAddress',
        'middleware' => 'can:ibusiness.businesses.create'
    ]);//parameters: address_id int
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

    /*
    $router->bind('userbusiness', function ($id) {
        return app('Modules\Ibusiness\Repositories\userbusinessRepository')->find($id);
    });
    */
    $router->get('userbusinesses', [
        'as' => 'admin.ibusiness.userbusiness.index',
        'uses' => 'UserBusinessController@index',
        'middleware' => 'can:ibusiness.userbusinesses.index'
    ]);
    $router->get('userbusinesses/create', [
        'as' => 'admin.ibusiness.userbusiness.create',
        'uses' => 'UserBusinessController@create',
        'middleware' => 'can:ibusiness.userbusinesses.create'
    ]);
    $router->post('userbusinesses', [
        'as' => 'admin.ibusiness.userbusiness.store',
        'uses' => 'UserBusinessController@store',
        'middleware' => 'can:ibusiness.userbusinesses.create'
    ]);
    $router->get('userbusinesses/{id}/edit', [
        'as' => 'admin.ibusiness.userbusiness.edit',
        'uses' => 'UserBusinessController@edit',
        'middleware' => 'can:ibusiness.userbusinesses.edit'
    ]);
    $router->put('userbusinesses/{userbusiness}', [
        'as' => 'admin.ibusiness.userbusiness.update',
        'uses' => 'UserBusinessController@update',
        'middleware' => 'can:ibusiness.userbusinesses.edit'
    ]);

    $router->delete('userbusinesses/{business_id}/user/{user_id}', [
        'as' => 'admin.ibusiness.userbusiness.destroy',
        'uses' => 'UserBusinessController@destroy',
        'middleware' => 'can:ibusiness.userbusinesses.destroy'
    ]);

    $router->get('getbranch/{business_id}', [
      'as' => 'admin.ibusiness.userbusiness.getbranchoffice',
      'uses' => 'UserBusinessController@getBranchOffice',
      'middleware' => 'can:ibusiness.userbusinesses.create'
    ]);

    $router->get('userbusinesses/searchUsers', [
        'as'    => 'admin.ibusiness.userbusiness.searchUsers',
        'uses'  => 'UserBusinessController@searchUsers'
    ]);

    $router->post('userbusinesses/{business_id}/addusers', [
        'as' => 'admin.ibusiness.userbusiness.addUsers',
        'uses' => 'UserBusinessController@addUsers'
    ]);


    $router->bind('orderapprovers', function ($id) {
        return app('Modules\Ibusiness\Repositories\OrderApproversRepository')->find($id);
    });
    $router->get('orderapprovers', [
        'as' => 'admin.ibusiness.orderapprovers.index',
        'uses' => 'OrderApproversController@index',
        'middleware' => 'can:ibusiness.orderapprovers.index'
    ]);
    $router->get('orderapprovers/create', [
        'as' => 'admin.ibusiness.orderapprovers.create',
        'uses' => 'OrderApproversController@create',
        'middleware' => 'can:ibusiness.orderapprovers.create'
    ]);
    $router->post('orderapprovers', [
        'as' => 'admin.ibusiness.orderapprovers.store',
        'uses' => 'OrderApproversController@store',
        'middleware' => 'can:ibusiness.orderapprovers.create'
    ]);
    $router->get('orderapprovers/{orderapprovers}/edit', [
        'as' => 'admin.ibusiness.orderapprovers.edit',
        'uses' => 'OrderApproversController@edit',
        'middleware' => 'can:ibusiness.orderapprovers.edit'
    ]);
    $router->put('orderapprovers/{orderapprovers}', [
        'as' => 'admin.ibusiness.orderapprovers.update',
        'uses' => 'OrderApproversController@update',
        'middleware' => 'can:ibusiness.orderapprovers.edit'
    ]);
    $router->delete('orderapprovers/{orderapprovers}', [
        'as' => 'admin.ibusiness.orderapprovers.destroy',
        'uses' => 'OrderApproversController@destroy',
        'middleware' => 'can:ibusiness.orderapprovers.destroy'
    ]);

    /*
    $router->bind('businessproduct', function ($id) {
        return app('Modules\Ibusiness\Repositories\businessproductRepository')->find($id);
    });
    */
    $router->get('businessproducts', [
        'as' => 'admin.ibusiness.businessproduct.index',
        'uses' => 'BusinessProductController@index',
        'middleware' => 'can:ibusiness.businessproducts.index'
    ]);
    $router->get('businessproducts/create', [
        'as' => 'admin.ibusiness.businessproduct.create',
        'uses' => 'BusinessProductController@create',
        'middleware' => 'can:ibusiness.businessproducts.create'
    ]);
    $router->post('businessproducts', [
        'as' => 'admin.ibusiness.businessproduct.store',
        'uses' => 'BusinessProductController@store',
        'middleware' => 'can:ibusiness.businessproducts.create'
    ]);
    $router->get('businessproducts/{id}/edit', [
        'as' => 'admin.ibusiness.businessproduct.edit',
        'uses' => 'BusinessProductController@edit',
        'middleware' => 'can:ibusiness.businessproducts.edit'
    ]);
    $router->post('import_product/{id}/', [
        'as' => 'admin.ibusiness.businessproduct.importproduct',
        'uses' => 'BusinessProductController@importProduct',
        'middleware' => 'can:ibusiness.businessproducts.edit'
    ]);
    $router->post('import_product_trapeq/{id}/', [
        'as' => 'admin.ibusiness.businessproduct.importproducttrapeq',
        'uses' => 'BusinessProductController@importProductTrapeq',
        'middleware' => 'can:ibusiness.businessproducts.edit'
    ]);
    $router->post('getProduct/', [
        'as' => 'admin.ibusiness.businessproduct.update',
        'uses' => 'BusinessProductController@getProduct',
        'middleware' => 'can:ibusiness.businessproducts.edit'
    ]);
    $router->post('updatePriceProduct/', [
        'as' => 'admin.ibusiness.businessproduct.update',
        'uses' => 'BusinessProductController@updatePriceProduct',
        'middleware' => 'can:ibusiness.businessproducts.edit'
    ]);
    $router->put('businessproducts/{businessproduct}', [
        'as' => 'admin.ibusiness.businessproduct.update',
        'uses' => 'BusinessProductController@update',
        'middleware' => 'can:ibusiness.businessproducts.edit'
    ]);
    $router->delete('businessproducts/{business_id}/product/{product_id}', [
        'as' => 'admin.ibusiness.businessproduct.destroy',
        'uses' => 'BusinessProductController@destroy',
        'middleware' => 'can:ibusiness.businessproducts.destroy'
    ]);

    $router->get('businessproducts/searchProducts', [
        'as'    => 'admin.ibusiness.businessproducts.searchProducts',
        'uses'  => 'BusinessProductController@searchProducts'
    ]);

    $router->post('businessproducts/{business_id}/addproducts', [
        'as' => 'admin.ibusiness.businessproducts.addProducts',
        'uses' => 'BusinessProductController@addProducts'
    ]);

    $router->get('businessproducts/{business_id}/searchTable', [
        'as'    => 'admin.ibusiness.businessproducts.searchTable',
        'uses'  => 'BusinessProductController@searchTable'
    ]);


    $router->bind('address', function ($id) {
        return app('Modules\Ibusiness\Repositories\AddressRepository')->find($id);
    });
    $router->get('addresses', [
        'as' => 'admin.ibusiness.address.index',
        'uses' => 'AddressController@index',
        'middleware' => 'can:ibusiness.addresses.index'
    ]);
    $router->get('addresses/create', [
        'as' => 'admin.ibusiness.address.create',
        'uses' => 'AddressController@create',
        'middleware' => 'can:ibusiness.addresses.create'
    ]);
    $router->post('addresses', [
        'as' => 'admin.ibusiness.address.store',
        'uses' => 'AddressController@store',
        'middleware' => 'can:ibusiness.addresses.create'
    ]);
    $router->get('addresses/{address}/edit', [
        'as' => 'admin.ibusiness.address.edit',
        'uses' => 'AddressController@edit',
        'middleware' => 'can:ibusiness.addresses.edit'
    ]);
    $router->put('addresses/{address}', [
        'as' => 'admin.ibusiness.address.update',
        'uses' => 'AddressController@update',
        'middleware' => 'can:ibusiness.addresses.edit'
    ]);
    $router->delete('addresses/{address}', [
        'as' => 'admin.ibusiness.address.destroy',
        'uses' => 'AddressController@destroy',
        'middleware' => 'can:ibusiness.addresses.destroy'
    ]);
// append








});
