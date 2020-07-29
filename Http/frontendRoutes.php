<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => trans('ibusiness::frontend.uri')], function (Router $router) {

    $locale = LaravelLocalization::setLocale() ?: App::getLocale();

});
