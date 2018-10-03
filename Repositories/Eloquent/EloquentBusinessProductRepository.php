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
    $businessProducts=$this->model->where('business_id',$business_id)->with('product','product.category')->get();
    //dd($businessProducts);
    return $businessProducts;
  }
  public function allProductOfBusinessTest($business_id,$filters,$includes){
    $query=$this->model->where('business_id',$business_id)->with('product','product.category')->get();
    //dd($businessProducts);
    return $query;
  }

  public function whereFilters($filters,$includes = array()){
    $query = count($includes) !== 0 ? $this->model->with($includes) : $this->model->with('product','product.category');
    if (isset($filters->business_id)) {
      $query->where('business_id', $filters->business_id);
    }
    if (isset($filters->order)) {
      $orderby = $filters->order->by ?? 'created_at';
      $ordertype = $filters->order->type ?? 'desc';
    } else {
      $orderby = 'created_at';
      $ordertype = 'desc';
    }
    $query->orderBy($orderby, $ordertype);
    if (isset($filter->take)) {
      $query->take($filter->take ?? 5);
      return $query->get();
    } elseif (isset($filter->paginate) && is_integer($filters->paginate)) {
      return $query->paginate($filters->paginate);
    } else {
      return $query->paginate(12);
    }
    return $query;
  }//where filters
}
