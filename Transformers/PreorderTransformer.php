<?php

namespace Modules\Ibusiness\Transformers;

use Illuminate\Http\Resources\Json\Resource;
//use Modules\Icommerce\Repositories\PaymentRepository;

class PreorderTransformer extends Resource
{
  public function toArray($request)
  {

    /*Get Payment Method Name*/
    /*
    foreach ($this->payments->getPaymentsMethods() as $payment)
        if($order->payment_method == $payment->configName)
          $order->payment_method = $payment->configTitle;
    */

    /*Get Products*/

    $products = [];
    foreach ($this->products as $product)
        array_push($products, [
          "title" => $product->title,
          "sku" => $product->sku,
          "quantity" => $product->pivot->quantity,
          "price" => $product->pivot->price,
          "priceFormat" => formatMoney($product->pivot->price),
          "total" => $product->pivot->total,
          "totalFormat" => formatMoney($product->pivot->total)
    ]);

    /*Get SubTotal*/
    if ($this->shipping_amount>0)
      $subtotal = $this->total - $this->shipping_amount;
    else
      $subtotal = $this->total;
    if ($this->tax_amount)
      $subtotal = $subtotal - $this->tax_amount;

    /*Get Approvers */
    $approvers = [];
    $approversCant = 0;

    // OJO ESTO No esta funcionando con las relacions Config dinamicas
    //dd($this->orderApprovers);

    if(isset($this->orderApprovers) && count($this->orderApprovers)>0){
      foreach ($this->orderApprovers as $approver)
          array_push($approvers, [
            "email" => $approver->user->email,
            "status" => ibusiness_get_Approverstatus()->get($approver->status),
            "comment" => (!empty($approver->comment)?$approver->comment:'-------'),
            "created_at" => $approver->created_at,
            "updated_at" =>$approver->updated_at
      ]);
      $approversCant++;
    }


    /*Values to return*/
    return [
      'id' => $this->id,
      'first_name' => $this->first_name,
      'last_name' => $this->last_name,
      'email' => $this->email,
      'total' => $this->total,
      'totalFormat' => formatMoney($this->total),
      'status' => $this->order_status,
      'status_name' => icommerce_get_Orderstatus()->get($this->order_status),
      'created_at' => $this->created_at,
      'url' => route(locale().'.ibusiness.preorder.show',[$this->id]),
      'payment_method' => $this->payment_method,
      'telephone' => $this->telephone,
      'invoice_nro' => $this->invoice_nro,
      'payment_company'=>$this->payment_company,
      'payment_firstname' => $this->payment_firstname,
      'payment_lastname' => $this->payment_lastname,
      'payment_address_1' => $this->payment_address_1,
      'payment_address_2' => $this->payment_address_2,
      'payment_postcode' => $this->payment_postcode,
      'payment_city' => $this->payment_city,
      'payment_zone' => $this->payment_zone,
      'payment_country' => $this->payment_country,
      'shipping_firstname' => $this->shipping_firstname,
      'shipping_lastname' => $this->shipping_lastname,
      'shipping_address_1' => $this->shipping_address_1,
      'shipping_address_2' => $this->shipping_address_2,
      'shipping_postcode' => $this->shipping_postcode,
      'shipping_city' => $this->shipping_city,
      'shipping_zone' => $this->shipping_zone,
      'shipping_country' => $this->shipping_country,
      'shipping_method' => $this->shipping_method,
      'shipping_amount' => $this->shipping_amount,
      'shipping_amountFormat' => formatMoney($this->shipping_amount),
      'products' => $products,
      'subtotal' => $subtotal,
      'subtotalFormat' => formatMoney($subtotal),
      'tax_amount' => $this->tax_amount,
      'tax_amountFormat' => formatMoney($this->tax_amount),
      'approvers' => $approvers,
      'approversCant' => $approversCant

    ];

  }
}
