<?php

namespace Modules\Ibusiness\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Log;
use Modules\Notification\Services\Notification;
use Modules\User\Contracts\Authentication;
use Modules\User\Repositories\UserRepository;
use Route;
use Modules\Ibusiness\Repositories\BusinessProductRepository;
use Modules\Ibusiness\Repositories\OrderApproversRepository;
class ProductController extends BasePublicController
{
  protected $auth;
  private $user;
  private $notification;
  private $businessproduct;
  private $orderApprovers;

  public function __construct(
      Notification $notification,
      Authentication $auth,
      UserRepository $user,
      BusinessProductRepository $businessproduct,
      OrderApproversRepository $orderApprovers
      )
  {

      parent::__construct();
      $this->auth = $auth;
      $this->user = $user;
      $this->notification = $notification;
      $this->businessproduct = $businessproduct;
      $this->orderApprovers = $orderApprovers;

  }
  public function Product(Request $request){
    try {
      $user = $this->auth->user();
        (isset($user) && !empty($user)) ? $user = $user->id : $user = 0;
      $businessproduct=$this->businessproduct->allProductOfBusiness($request->business_id);
      return ['businessproduct'=>$businessproduct];
    } catch (\ErrorException $e) {
        $status = 500;
        $response = ['errors' => [
            "code" => "501",
            "source" => [
                "pointer" => "api/ibusiness/preorders",
            ],
            "title" => "Error Business product",
            "detail" => $e
        ]
        ];
    }
  }//BusinessProducts()
}
