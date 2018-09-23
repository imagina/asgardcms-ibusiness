<?php

namespace Modules\Ibusiness\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Log;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Ibusiness\Transformers\PreorderTransformer;
use Modules\Ibusiness\Repositories\OrderApproversRepository;
use Modules\Ibusiness\Entities\OrderApprovers;
use Modules\Icommerce\Repositories\OrderRepository;
use Modules\Icommerce\Entities\Order;
use Modules\Notification\Services\Notification;
use Modules\User\Contracts\Authentication;
use Modules\User\Repositories\UserRepository;
use Route;

class PreorderController extends BasePublicController
{

    protected $auth;

    private $user;
    private $order;
    private $notification;
    private $businessproduct;
    private $orderApprovers;

    public function __construct(
        Notification $notification,
        Authentication $auth,
        UserRepository $user,
        OrderRepository $order,
        OrderApproversRepository $orderApprovers
        )
    {

        parent::__construct();
        $this->auth = $auth;
        $this->user = $user;
        $this->order = $order;
        $this->notification = $notification;
        $this->orderApprovers = $orderApprovers;

    }


    public function preorders(Request $request)
    {
        try {
            $user = $this->user->find($request->user);
            if($user->roles()->first()->slug=="buyer"){
                $response['preorders'] = PreorderTransformer::collection($this->order->whereUser($user->id));
            }else{
                if($user->roles()->first()->slug=="approver"){
                    $response['preorders'] = PreorderTransformer::collection($this->orderApprovers->getOrders($user->id));
                }
            }
        } catch (\ErrorException $e) {
            $status = 500;
            $response = ['errors' => [
                "code" => "501",
                "source" => [
                    "pointer" => "api/ibusiness/preorders",
                ],
                "title" => "Error",
                "detail" => $e->getMessage()
            ]
            ];
        }
        return response()->json($response, $status ?? 200);
    }//preorders()

    public function preorder(Order $preorder){
        try {
          // dd(OrderApprovers::where('order_id',15)->get());
            $response = new PreorderTransformer($preorder);
        } catch (\Exception $e) {
            \Log::error($e);
            $status = 500;
            $response = ['errors' => [
                "code" => "501",
                "source" => [
                    "pointer" => "api/ibusiness/preorder",
                ],
                "title" => "Error",
                "detail" => $e->getMessage()
            ]
            ];
        }
        return response()->json($response, $status ?? 200);
    }//preorder()

}
