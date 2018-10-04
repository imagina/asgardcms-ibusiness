<?php

namespace Modules\Ibusiness\Repositories\Eloquent;

use Modules\Ibusiness\Repositories\userbusinessRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Illuminate\Support\Collection;
class EloquentUserBusinessRepository extends EloquentBaseRepository implements userbusinessRepository
{
  public function getBusinessUser($user_id){
    return $this->model->with('business','business.addresses')->where('user_id',$user_id)->get();
  }
  public function getUsersBuyersOfBusiness($business_id){
    $users=$this->model->with('business','user')->where('business_id',$business_id)->get();
    $buyers=new Collection();
    foreach($users as $user){
      if($user->user->roles()->first()->slug=="buyer"){
        $buyers=$buyers->merge([$user->user]);
      }
    }
    return $buyers;
  }//getUsersBuyersOfBusiness()
  public function getUsersApproversOfBusiness($business_id){
    $users=$this->model->with('business','user')->where('business_id',$business_id)->get();
    $buyers=new Collection();
    foreach($users as $user){
      if($user->user->roles()->first()->slug=="approver"){
        $buyers=$buyers->merge([$user->user]);
      }
    }
    return $buyers;
  }//getUsersBuyersOfBusiness()
}
