<?php

namespace Modules\Ibusiness\Repositories\Eloquent;

use Modules\Ibusiness\Repositories\BusinessRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentBusinessRepository extends EloquentBaseRepository implements BusinessRepository
{
  public function companies(){
    $companies=$this->model->where('parent_id',0)->get();
    return $companies;
  }

  public function branchOffice($business_id){
    return $this->model->where('parent_id',$business_id)->get();
  }

  public function getById($id){
    return $this->model->where('id',$id)->first();
  }

}
