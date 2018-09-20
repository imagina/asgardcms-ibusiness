<?php

namespace Modules\Ibusiness\Repositories\Eloquent;

use Modules\Ibusiness\Repositories\OrderApproversRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Icommerce\Entities\Order;

class EloquentOrderApproversRepository extends EloquentBaseRepository implements OrderApproversRepository
{

    public function getOrders($user_id){
        $orderApprovers = $this->model->with('order')->where('user_id',$user_id)->get();
        $orders = collect([]);
        foreach($orderApprovers as $orderApprover)
            $orders->push($orderApprover->order);
        return $orders;
    }

    public function whereUserAndOrder($user_id,$order_id){
        return $this->model->where([
            ['user_id', '=', $user_id],
            ['order_id', '=', $order_id]
            ])->first();
    }

    public function validateAllApproversApproved($order_id){
      //If return true, all approvers approved the pre-order
      $approvers=$this->model->where('order_id',$order_id)->get();
      foreach($approvers as $approver){
        if($approver->status!=0){
          return false;
        }
      }//foreach
      return true;
    }
}
