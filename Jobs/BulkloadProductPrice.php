<?php

namespace Modules\Ibusiness\Jobs;

use Couchbase\Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Ibusiness\Entities\BusinessProduct;
use Modules\Icommerce\Entities\Product;
class BulkloadProductPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    protected $business_id;
    protected $business;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$business_id,$business)
    {
        $this->business=$business;
        $this->data=$data;
        $this->business_id=$business_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function existProduct($product_id){
      //Validate that the product exists in the table Products
      $product=Product::find($product_id);
      if(count($product)>0)
      return true;
      else
      return false;
    }//existProduct

    public function handle()
    {
        try {
          foreach ($this->data as $product){
            if($this->existProduct($product->product_id)){
              $businessProduct=BusinessProduct::where('business_id',$this->business_id)->where('product_id',$product->product_id)->first();
              if(count($businessProduct)==0){
                $businessProduct= new BusinessProduct();
                $businessProduct->price=$product->price;
                $businessProduct->business_id=$this->business_id;
                $businessProduct->product_id=$product->product_id;
                $businessProduct->save();
              }else{
                $business = $this->business->getById($this->business_id);
                $business->products()->updateExistingPivot($product->product_id,['price'=>$product->price]);
              }//else
            }//if
          }//foreach

        } catch (\Exception $e) {

            \Log::error($e->getMessage());
            dd($this->data,$this->business_id,$e->getMessage());
        }

    }

}
