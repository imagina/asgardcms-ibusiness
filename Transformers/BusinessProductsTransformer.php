<?php

namespace Modules\Ibusiness\Transformers;

use Illuminate\Http\Resources\Json\Resource;
//use Modules\Icommerce\Repositories\PaymentRepository;

class BusinessProductsTransformer extends Resource
{
  public function toArray($request)
  {
    /*valida la imagen del producto*/
    if (isset($this->product->options->mainimage) && !empty($this->product->options->mainimage)) {
        $image = url($this->product->options->mainimage);
    } else {
        $image = url('modules/icommerce/img/product/default.jpg');
    }
    /*Values to return*/
    return [
      'title'=>$this->product->title,
      'slug'=>$this->product->slug,
      'quantity'=>$this->product->quantity,
      'image'=>$image,
      'price'=>$this->price,
      'product_id'=>$this->product->id,
      'businessproduct_id'=>$this->id,
      'category_name'=>$this->product->category->title,
      'category_id'=>$this->product->category->id
    ];
  }
}
