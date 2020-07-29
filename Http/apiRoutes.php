<?php

use Illuminate\Routing\Router;


$router->group(['prefix' => '/ibusiness/v1'/*,'middleware' => ['auth:api']*/], function (Router $router) {
  //======  Business
    require('ApiRoutes/BusinessRoutes.php');
  //======  Type Business
    require('ApiRoutes/TypeRoutes.php');
});
