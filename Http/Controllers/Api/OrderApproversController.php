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
use Modules\Setting\Contracts\Setting;

class OrderApproversController extends BasePublicController
{

    protected $auth;

    private $user;
    private $order;
    private $orderApprovers;
    private $setting;

    public function __construct(
        Authentication $auth,
        UserRepository $user,
        OrderRepository $order,
        OrderApproversRepository $orderApprovers,
        Setting $setting
        )
    {

        parent::__construct();
        $this->auth = $auth;
        $this->user = $user;
        $this->order = $order;
        $this->orderApprovers = $orderApprovers;
        $this->setting = $setting;

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
          //All approvers approved preorder
          Order::where('id',$request->order_id)->update(['order_status'=>0]);
          Order_History::create([
            'order_id' => $request->order_id,
            'status' => 0,
            'notify' => 1,
          ]);
          //Send mail admin:
          $email_from = $this->setting->get('icommerce::from-email');
          $email_to = explode(',',$this->setting->get('icommerce::form-emails'));
          $sender  = $this->setting->get('core::site-name');
          $order = $this->order->find($request->order_id);
          $products=[];
          foreach ($order->products as $product) {
              array_push($products,[
                  "title" => $product->title,
                  "sku" => $product->sku,
                  "quantity" => $product->pivot->quantity,
                  "price" => $product->pivot->price,
                  "total" => $product->pivot->total,
              ]);
          }//foreach products
          $userEmail = $order->email;
          $userFirstname = "{$order->first_name} {$order->last_name}";
          $content=[
              'order'=> $order,
              'products' => $products,
              'user' => $userFirstname
          ];
          $msjTheme = "icommerce::email.success_order";
          $msjSubject = trans('icommerce::common.emailSubject.approved').$order->id;
          $msjIntro = trans('icommerce::common.emailIntro.approved');
          $mailAdmin = icommerce_emailSend(['email_from'=>[$email_from],'theme' => $msjTheme,'email_to' => $email_to,'subject' => $msjSubject, 'sender'=>$sender,'data' => array('title' => $msjSubject,'intro'=> $msjIntro,'content'=>$content)]);
          $mailUser= icommerce_emailSend(['email_from'=>[$email_from],'theme' => $msjTheme,'email_to' => $userEmail,'subject' => $msjSubject, 'sender'=>$sender,'data' => array('title' => $msjSubject,'intro'=> $msjIntro,'content'=>$content)]);
        }//if all approvers approved preorder
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
