<?php

namespace Modules\Ibusiness\Http\Controllers;

use Mockery\CountValidator\Exception;

use Modules\User\Contracts\Authentication;
use Modules\Core\Http\Controllers\BasePublicController;
use Route;
use Illuminate\Http\Request;
use Log;
use Modules\Ibusiness\Repositories\BusinessRepository;
use Modules\Ibusiness\Repositories\UserBusinessRepository;
use Modules\Ibusiness\Repositories\BusinessProductRepository;
use Modules\Icommerce\Repositories\CurrencyRepository;
use Modules\Icommerce\Repositories\PaymentRepository;
use Modules\Icommerce\Repositories\OrderRepository;
use Modules\Icommerce\Entities\Order;
use Modules\Icommerce\Entities\Order_History;
use Modules\Icommerce\Entities\Order_Product;
use Modules\Ibusiness\Entities\Business;
use Modules\Ibusiness\Entities\OrderApprovers;

class PublicController extends BasePublicController
{

    protected $auth;
    protected $business;
    protected $userbusiness;
    protected $businessproduct;
    private $order;
    private $currency;
    private $payments;


    public function __construct(BusinessRepository $business,PaymentRepository $payments,UserBusinessRepository $userbusiness,CurrencyRepository $currency,BusinessProductRepository $businessproduct,OrderRepository $order)
    {
        parent::__construct();
        $this->auth = app(Authentication::class);
        $this->business = $business;
        $this->userbusiness = $userbusiness;
        $this->businessproduct = $businessproduct;
        $this->currency = $currency;
        $this->order = $order;
        $this->payments = $payments;
    }

    /**
     * List PreOrders
     *
     * @return view
     */
    public function index()
    {

        $user = $this->auth->user();
        $userRol = $user->roles()->first()->slug;

        (isset($user) && !empty($user)) ? $user = $user->id : $user = 0;

        $tpl = 'ibusiness::frontend.index';

        return view($tpl,compact('user','userRol'));

    }

    /**
     * Show PreOrder
     *
     * @return view
     */
    public function show($id)
    {

        $user = $this->auth->user();
        $userRol = $user->roles()->first()->slug;

        (isset($user) && !empty($user)) ? $user = $user->id : $user = 0;

        $tpl = 'ibusiness::frontend.show';

        $orderID = $id;

        return view($tpl,compact('user','userRol','orderID'));

    }

     /**
     * Create Preorder
     *
     * @return view
     */
    public function preorderCreate()
    {
        $user = $this->auth->user();
        (isset($user) && !empty($user)) ? $user = $user->id : $user = 0;
        $businesses = $this->business->companies();//All companies - not branch officess
        $userbusiness=$this->userbusiness->getBusinessUser($user);//Get business of user
        $currency = $this->currency->getActive();
        $payments = $this->payments->getPaymentsMethods();
        $tpl = 'ibusiness::frontend.create-preorder';
        return view($tpl,compact('user','businesses','userbusiness','currency','payments'));
    }//preorderCreate

    public function preorderCreatePost(Request $request){
      //$request->business_id
      //$request->businessproducts
      $buyers=$this->userbusiness->getUsersBuyersOfBusiness($request->business_id);
      if(count($buyers)==0)
        return response()->json(['error'=>500,'message'=>trans('ibusiness::frontend.validation.not_rol_approver')]);
      $user = $this->auth->user();
      $currency = $this->currency->getActive();
      $business=Business::where('id',$request->business_id)->with('addresses')->first();
      $request["ip"] = $request->ip();
      $request["user_agent"] = $request->header('User-Agent');
      $request['order_status'] = 10;
      $request['key'] = substr(md5 (date("Y-m-d H:i:s").$request->ip()),0,20);
      //calcular total $total
      $total=0;
      foreach($request->businessproducts as $product)
        $total=$total+(floatval($product['quantity']) * floatval($product['price_unit']));
      $request['total']=$total;
      $request['user_id']=$user->id;
      $request['first_name']=$business->person_firstname;
      $request['lastname']=$business->person_lastname;
      $request['email']=$business->email;
      $request['telephone']=$business->phone;
      $request['currency_id']=$currency->id;
      $request['currency_code']=$currency->code;
      $request['currency_value']=$currency->value;
      $b=0;
      foreach($business->addresses as $address){
        if($b==2){
          break;
        }
        if($address->type=="billing"){
          $b++;
          $request['payment_firstname']=$address->firstname;
          $request['payment_lastname']=$address->lastname;
          $request['payment_company']=$business->name;
          $request['payment_address_1']=$address->address_1;
          $request['payment_address_2']=$address->address_2;
          $request['payment_city']=$address->city;
          $request['payment_postcode']=$address->postcode;
          $request['payment_country']=$address->country;
          $request['payment_zone']=$address->zone;
          $request['payment_method']=$request->payment_method;
          $request['payment_code']=$request->payment_method;
        }else if($address->type=="shipping"){
          $b++;
          $request['shipping_firstname']=$address->firstname;
          $request['shipping_lastname']=$address->lastname;
          $request['shipping_company']=$business->name;
          $request['shipping_address_1']=$address->address_1;
          $request['shipping_address_2']=$address->address_2;
          $request['shipping_city']=$address->city;
          $request['shipping_postcode']=$address->postcode;
          $request['shipping_country']=$address->country;
          $request['shipping_zone']=$address->zone;
          $request['shipping_method']='0';
          $request['shipping_code']='0';
          $request['shipping_amount']=0;
          $request['tax_amount']=0;
        }
      }//foreach
      //dd($request->all());
      try {
        $order = Order::create($request->all());
      } catch (Exception $e) {
        \Log::info($e->getMessage());
        return response()->json(['error'=>500,'message'=>trans('icommerce::checkout.alerts.error_order').$e->getMessage()]);
      }//try catch order
      try {
        Order_History::create([
          'order_id' => $order->id,
          'status' => $order->order_status,
          'notify' => 1,
        ]);
      } catch (Exception $e) {
        \Log::info($e->getMessage());
        return response()->json([
          "status" => "500",
          "message" => trans('icommerce::checkout.alerts.error_order') . $e->getMessage()
        ]);
      }//try catch order history
      try {
        foreach ($request->businessproducts as $item) {
          Order_Product::create([
            "order_id" => $order->id,
            "product_id" => $item['id'],
            "title" => $item['name'],
            "quantity" => $item['quantity'],
            "price" => floatval($item['price_unit']),
            "total" => floatval($item['quantity']) * floatval($item['price_unit']),
            "tax" => 0,
            "reward" => 0,
          ]);
        }
      } catch (Exception $e) {
        \Log::info($e->getMessage());
        return response()->json([
          "status" => "500",
          "message" => trans('icommerce::checkout.alerts.error_order') . $e->getMessage()
        ]);
      }//try catch order_product
      try {
        foreach($buyers as $buyer){
          OrderApprovers::create([
            "order_id"=>$order->id,
            "user_id"=>$buyer->id,
            "status"=>10,
            "comment"=>""
          ]);
        }//foreach
      } catch (Exception $e) {
        \Log::info($e->getMessage());
        return response()->json([
          "status" => "500",
          "message" => trans('icommerce::checkout.alerts.error_order') . $e->getMessage()
        ]);
      }//try catch order_approvers
      return response()->json([
        "status" => "202",
        "message" => trans('icommerce::checkout.alerts.order_created')
      ]);
    }//preorderCreatePost

    public function procesos()
    {

        $tpl = 'ibusiness::frontend.procesos';

        return view($tpl);

    }




}
