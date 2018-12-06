<?php

namespace Modules\Ibusiness\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ibusiness\Entities\Business;
use Modules\Ibusiness\Entities\Address;
use Modules\Ibusiness\Entities\Addressables;
use Modules\Ibusiness\Http\Requests\CreateBusinessRequest;
use Modules\Ibusiness\Http\Requests\UpdateBusinessRequest;
use Modules\Ibusiness\Repositories\BusinessRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class BusinessController extends AdminBaseController
{
    /**
     * @var BusinessRepository
     */
    private $business;

    public function __construct(BusinessRepository $business)
    {
        parent::__construct();

        $this->business = $business;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // $businesses = $this->business->all();
        $businesses = $this->business->companies();
        return view('ibusiness::admin.businesses.index', compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      //$businesses = $this->business->all();
      $businesses = $this->business->companies();
        return view('ibusiness::admin.businesses.create', compact('businesses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBusinessRequest $request
     * @return Response
     */
    public function store(CreateBusinessRequest $request)
    {
        // unset($request['_token']);
        $businessData=array();
        $businessData=array_merge($businessData,['_token'=>$request->_token,'name'=>$request->name,
                                                'description'=>$request->description,'phone'=>$request->phone,
                                                'nit'=>$request->nit,'budget'=>$request->budget,"parent_id"=>0,
                                                'person_firstname'=>$request->person_first_name,'person_lastname'=>$request->person_last_name,"email"=>$request->email]);
        $addressData=array();
        $addressData=array_merge($addressData,['_token'=>$request->token,'firstname'=>$request->firstname,'lastname'=>$request->lastname,
                                              'address_1'=>$request->address_1,'address_2'=>$request->address_2,'type'=>$request->type,
                                              'postcode'=>$request->postcode,'country'=>$request->country,'city'=>$request->city,'zone'=>$request->zone]);
        $business=Business::create($businessData);//business
        $address=Address::create($addressData);//address
        $addressable=Addressables::create(['address_id'=>$address->id,'ibusiness__addressables_id'=>$business->id,"ibusiness__addressables_type"=>'Modules\Ibusiness\Entities\Business']);
        //dd($business,$address,$addressable);
        if(isset($request->addressShipping)){
          $addressData=array();
          $addressData=array_merge($addressData,['_token'=>$request->token,'firstname'=>$request->firstname,'lastname'=>$request->lastname,
                                                'address_1'=>$request->address_1,'address_2'=>$request->address_2,'type'=>"shipping",
                                                'postcode'=>$request->postcode,'country'=>$request->country,'city'=>$request->city,'zone'=>$request->zone]);
          $address=Address::create($addressData);//address
          $addressable=Addressables::create(['address_id'=>$address->id,'ibusiness__addressables_id'=>$business->id,"ibusiness__addressables_type"=>'Modules\Ibusiness\Entities\Business']);
        }//new address shipping
        else{
          $addressShippingData=array();
          $addressShippingData=array_merge($addressShippingData,['_token'=>$request->token,'firstname'=>$request->firstname_shipping,'lastname'=>$request->lastname_shipping,
                                                'address_1'=>$request->address_1_shipping,'address_2'=>$request->address_2_shipping,'type'=>$request->type_shipping,
                                                'postcode'=>$request->postcode_shipping,'country'=>$request->country_shipping,'city'=>$request->city_shipping,'zone'=>$request->zone_shipping]);
          $address=Address::create($addressShippingData);//address
          $addressable=Addressables::create(['address_id'=>$address->id,'ibusiness__addressables_id'=>$business->id,"ibusiness__addressables_type"=>'Modules\Ibusiness\Entities\Business']);
        }//if address shipping equal billing
        return redirect()->route('admin.ibusiness.business.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ibusiness::businesses.title.businesses')]));
    }

    public function storeAddress(Request $request){
      $address=Address::create($request->address);//address
      $addressable=Addressables::create(['address_id'=>$address->id,'ibusiness__addressables_id'=>$request->business_id,"ibusiness__addressables_type"=>'Modules\Ibusiness\Entities\Business']);
      return response()->json(['success'=>1,'address_id'=>$address->id,'message'=>trans('core::core.messages.resource created', ['name' => trans('ibusiness::businesses.title.address')])]);
    }//storeAddress()

    public function createBranchOffice($business_id){
      $business=Business::where('id',$business_id)->with('addresses')->first();//company parent_id
      return view('ibusiness::admin.businesses.create-branchOffice', ['business_id'=>$business_id,'business'=>$business]);
    }//createBranchOffice()

    public function storeBranchOffice(CreateBusinessRequest $request){
      $address_id=0;
      $businessData=array();
      $businessData=array_merge($businessData,['_token'=>$request->_token,'name'=>$request->name,
                                              'description'=>$request->description,'phone'=>$request->phone,
                                              'nit'=>$request->nit,'budget'=>$request->budget,"parent_id"=>$request->parent_id,
                                              'person_firstname'=>$request->person_first_name,'person_lastname'=>$request->person_last_name,"email"=>$request->email]);
      $addressData=array();
      $addressData=array_merge($addressData,['_token'=>$request->token,'firstname'=>$request->firstname,'lastname'=>$request->lastname,
                                            'address_1'=>$request->address_1,'address_2'=>$request->address_2,'type'=>$request->type,
                                            'postcode'=>$request->postcode,'country'=>$request->country,'city'=>$request->city,'zone'=>$request->zone]);
      $business=Business::create($businessData);//business
      $address=Address::create($addressData);//address
      $addressable=Addressables::create(['address_id'=>$address->id,'ibusiness__addressables_id'=>$business->id,"ibusiness__addressables_type"=>'Modules\Ibusiness\Entities\Business']);
      if($request->addressBilling=="10"){
        //dd('misma direccion, para envio');
        $addressData=array();
        $addressData=array_merge($addressData,['_token'=>$request->token,'firstname'=>$request->firstname,'lastname'=>$request->lastname,
                                              'address_1'=>$request->address_1,'address_2'=>$request->address_2,'type'=>"billing",
                                              'postcode'=>$request->postcode,'country'=>$request->country,'city'=>$request->city,'zone'=>$request->zone]);
        $address=Address::create($addressData);//address
        $addressable=Addressables::create(['address_id'=>$address->id,'ibusiness__addressables_id'=>$business->id,"ibusiness__addressables_type"=>'Modules\Ibusiness\Entities\Business']);

      }else if($request->addressBilling=="20"){
        //misma dirección de facturacion de la empresa padre
        $businessParent=Business::where('id',$request->parent_id)->with('addresses')->first();
        foreach($businessParent->addresses as $addressParent){
          if($addressParent->type=="billing"){
            $address_id=$addressParent->id;
            break;
          }//if address equal billing
        }//addresses parent company
        $addressable=Addressables::create(['address_id'=>$address_id,'ibusiness__addressables_id'=>$business->id,"ibusiness__addressables_type"=>'Modules\Ibusiness\Entities\Business']);
      }else if($request->addressBilling=="30"){
        //dd('nueva direccion _billing');
        $addressData=array();
        $addressData=array_merge($addressData,['_token'=>$request->token,'firstname'=>$request->firstname_billing,'lastname'=>$request->lastname_billing,
                                              'address_1'=>$request->address_1_billing,'address_2'=>$request->address_2_billing,'type'=>"billing",
                                              'postcode'=>$request->postcode_billing,'country'=>$request->country_billing,'city'=>$request->city_billing,'zone'=>$request->zone_billing]);
        $address=Address::create($addressData);//address
        $addressable=Addressables::create(['address_id'=>$address->id,'ibusiness__addressables_id'=>$business->id,"ibusiness__addressables_type"=>'Modules\Ibusiness\Entities\Business']);
      }
      return redirect()->route('admin.ibusiness.business.edit', [$request->parent_id])
          ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ibusiness::businesses.title.branchoffice')]));
    }//storeBranchOffice()

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Business $business
     * @return Response
     */
    public function edit(Business $business)
    {
      $business=Business::where('id',$business->id)->with('addresses')->first();
      $branchoffices=Business::where('parent_id',$business->id)->with('addresses')->get();
      // dd($business,$branchoffices);
      $businesses = $this->business->all();
      return view('ibusiness::admin.businesses.edit', compact('business','businesses','branchoffices'));
    }//edit()

    /**
     * Update the specified resource in storage.
     *
     * @param  Business $business
     * @param  UpdateBusinessRequest $request
     * @return Response
     */
    public function update(Business $business, UpdateBusinessRequest $request)
    {
        $this->business->update($business, $request->all());
        if($business->parent_id==0){
          return redirect()->route('admin.ibusiness.business.index')
          ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibusiness::businesses.title.businesses')]));
        }else{
          return redirect()->route('admin.ibusiness.business.edit', [$business->parent_id])
              ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibusiness::businesses.title.branchoffice')]));
        }
    }

    public function updateAddress(Request $request){
      $address=Address::find($request->address_id);//address
      $address->firstname=$request->firstname;
      $address->lastname=$request->lastname;
      $address->address_1=$request->address_1;
      $address->address_2=$request->address_2;
      $address->country=$request->country;
      $address->zone=$request->zone;
      $address->city=$request->city;
      $address->type=$request->type;
      $address->postcode=$request->postcode;
      $address->update();
      return response()->json(['success'=>1,'message'=>trans('core::core.messages.resource updated', ['name' => trans('ibusiness::businesses.title.address')])]);
    }//updateAddress()

    /**
     * Remove the specified resource from storage.
     *
     * @param  Business $business
     * @return Response
     */
    public function destroy(Business $business)
    {
        $this->business->destroy($business);
        if($business->parent_id==0){
          return redirect()->route('admin.ibusiness.business.index')
          ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ibusiness::businesses.title.businesses')]));
        }
        else{
          return redirect()->route('admin.ibusiness.business.edit', [$business->parent_id])
          ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ibusiness::businesses.title.branchoffice')]));
        }
    }
    /**
      *Delete address
      *@param address_id
    */
    public function deleteAddress(Request $request){
      $addressable=Addressables::where('address_id',$request->address_id)->where('ibusiness__addressables_id',$request->business_id)->first();
      $moreAddress=Addressables::where('ibusiness__addressables_id',$addressable->ibusiness__addressables_id)->count();
      $business=Business::where('id',$request->business_id)->first();
      if($moreAddress>1){
        $address=Address::find($request->address_id);//address
        if($business->parent_id==0)
          $address->delete();//delete in address
        $addressable->delete();//delete in addressable
        return response()->json(['success'=>1,'message'=>trans('core::core.messages.resource deleted', ['name' => trans('ibusiness::businesses.title.address')])]);
      }else
      return response()->json(['success'=>0,'message'=>trans('ibusiness::businesses.messages.mustOneAddress')]);
    }//deleteAddress
    /**
      *set address
      *@param business_id
    */
    public function setAddress(Request $request){
      $branchOffice=Business::where('id',$request->business_id)->with('addresses')->first();
      $business=Business::where('id',$branchOffice->parent_id)->with('addresses')->first();
      $address_id=0;
      $addressBilling;
      $b=0;
      foreach($business->addresses as $address){
        if($address->type=="billing"){
          $address_id=$address->id;
          $addressBilling=$address;
        }//address billing
      }//addresses parent business
      foreach($branchOffice->addresses as $addressBranch){
        if($addressBranch->type=="billing"){
          if($addressBranch->id==$address_id){
            $b=1;
            break;
          }
          else{
            $addressNew=Address::find($addressBranch->id);//address
            $addressNew->type=null;
            $addressNew->update();
          }//else
        }//address
      }//foreach addresses of branch office
      if($b==1)
        return response()->json(['success'=>0,'message'=>trans('ibusiness::businesses.messages.address_exist_branchOffice')]);
      else
        $addressable=Addressables::create(['address_id'=>$address_id,'ibusiness__addressables_id'=>$request->business_id,"ibusiness__addressables_type"=>'Modules\Ibusiness\Entities\Business']);
      return response()->json(['success'=>1,'message'=>trans('ibusiness::businesses.messages.address_associated_branch'),'newAddress'=>$addressBilling]);
    }//setAddress

    /**
    * view import and export from ibusiness.
    * @return View
    */
    public function indexImport(){
      return view('ibusiness::admin.businesses.bulkload.index');
    }
    
    public function importBusinesses(Request $request)
    {
      $msg="";
      try {
        $data_excel = Excel::import(new BusinessesImport(), $request->importfile);
        $msg=trans('ibusiness::businesses.bulkload.success migrate');
        return redirect()->route('admin.ibusiness.business.index')
        ->withSuccess($msg);
      } catch (Exception $e) {
        $msg  =  trans('ibusiness::businesses.bulkload.error in migrate');
        return redirect()->route('admin.ibusiness.business.index')
        ->withError($msg);
      }
    }//importBusinesses()
}
