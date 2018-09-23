<?php

namespace Modules\Ibusiness\Repositories\Eloquent;

use Modules\Ibusiness\Repositories\BusinessProductRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentBusinessProductRepository extends EloquentBaseRepository implements BusinessProductRepository
{
  public function relationProduct($business_id,$product_id){
    return $this->model->where('business_id',$business_id)->with('product')->where('product_id',$product_id)->first();
  }
  public function allProductOfBusiness($business_id){
    return $this->model->where('business_id',$business_id)->with('product','product.category')->get();
  }
}
