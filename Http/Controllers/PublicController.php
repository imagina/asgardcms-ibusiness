<?php

namespace Modules\Ibusiness\Http\Controllers;

use Modules\User\Contracts\Authentication;
use Modules\Core\Http\Controllers\BasePublicController;
use Illuminate\Http\Request;

class PublicController extends BasePublicController
{

  protected $auth;

  public function __construct()
  {
    parent::__construct();
    $this->auth = app(Authentication::class);
  }



}
