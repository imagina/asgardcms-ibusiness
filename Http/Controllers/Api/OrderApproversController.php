<?php

namespace Modules\Ibusiness\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Log;
use Route;
use Modules\User\Contracts\Authentication;
use Modules\Notification\Services\Notification;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Ibusiness\Entities\OrderApproversStatus;
use Modules\Ibusiness\Entities\OrderApprovers;
use Modules\Icommerce\Entities\Order_History;
use Modules\Icommerce\Entities\Order;
use Modules\Icommerce\Repositories\OrderRepository;
use Modules\Ibusiness\Repositories\OrderApproversRepository;
use Modules\User\Repositories\UserRepository;

class OrderApproversController extends BasePublicController
{

    protected $auth;

    private $user;
    private $order;
    private $orderApprovers;

    public function __construct(
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
        $this->orderApprovers = $orderApprovers;

    }


    public function getStatus()
    {

        try {

            $ApproversStatus = new OrderApproversStatus();
            $response = $ApproversStatus->lists();

        } catch (\ErrorException $e) {
            $status = 500;
            $response = ['errors' => [
                "code" => "501",
                "source" => [
                    "pointer" => "api/ibusiness/orderapprovers",
                ],
                "title" => "Error",
                "detail" => $e->getMessage()
            ]
            ];
        }

        return response()->json($response, $status ?? 200);
    }

    public function getDataApprover($orderID,Request $request){

        try {

            $user = $this->user->find($request->user);
            $response = $this->orderApprovers->whereUserAndOrder($user->id,$orderID);

        } catch (\ErrorException $e) {
            $status = 500;
            $response = ['errors' => [
                "code" => "501",
                "source" => [
                    "pointer" => "api/ibusiness/orderapprovers",
                ],
                "title" => "Error",
                "detail" => $e->getMessage()
            ]
            ];
        }

        return response()->json($response, $status ?? 200);

    }

    public function update(Request $request){
      try {
        $response=OrderApprovers::where('order_id',$request->order_id)->where('user_id',$request->approver_id)->update(['status'=>$request->status_id,'comment'=>$request->comment]);
        $approved=$this->orderApprovers->validateAllApproversApproved($request->order_id);
        if($approved){
          Order::where('id',$request->order_id)->update(['order_status'=>0]);
          Order_History::where('id',$request->order_id)->update([
            'status' => 0,
            'notify' => 1,
          ]);
        }
      } catch (\ErrorException $e) {
        $status = 500;
        $response = ['errors' => [
            "code" => "501",
            "source" => [
                "pointer" => "api/ibusiness/orderapprovers/",
            ],
            "title" => "Error",
            "detail" => $e->getMessage()
        ]
        ];
      }
      return response()->json($response, $status ?? 200);
    }

}
