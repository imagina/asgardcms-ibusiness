<?php

return [
    'ibusiness.businesses' => [
        'index' => 'ibusiness::businesses.list resource',
        'create' => 'ibusiness::businesses.create resource',
        'edit' => 'ibusiness::businesses.edit resource',
        'destroy' => 'ibusiness::businesses.destroy resource',
    ],
    'ibusiness.userbusinesses' => [
        'index' => 'ibusiness::userbusinesses.list resource',
        'create' => 'ibusiness::userbusinesses.create resource',
        'edit' => 'ibusiness::userbusinesses.edit resource',
        'destroy' => 'ibusiness::userbusinesses.destroy resource',
    ],
    'ibusiness.orderapprovers' => [
        'index' => 'ibusiness::orderapprovers.list resource',
        'create' => 'ibusiness::orderapprovers.create resource',
        'edit' => 'ibusiness::orderapprovers.edit resource',
        'destroy' => 'ibusiness::orderapprovers.destroy resource'
    ],
    'ibusiness.businessproducts' => [
        'index' => 'ibusiness::businessproducts.list resource',
        'create' => 'ibusiness::businessproducts.create resource',
        'edit' => 'ibusiness::businessproducts.edit resource',
        'destroy' => 'ibusiness::businessproducts.destroy resource',
    ],
    'ibusiness.addresses' => [
        'index' => 'ibusiness::addresses.list resource',
        'create' => 'ibusiness::addresses.create resource',
        'edit' => 'ibusiness::addresses.edit resource',
        'destroy' => 'ibusiness::addresses.destroy resource',
    ],
    'ibusiness.orders.permissions'=>[
      'index' => 'ibusiness::businesses.permissions.list preorders',
      'create' => 'ibusiness::businesses.permissions.create preorders',
      'update' => 'ibusiness::businesses.permissions.update order approver',
      'edit'=>'ibusiness::businesses.permissions.edit preorder'

    ],
// append








];
