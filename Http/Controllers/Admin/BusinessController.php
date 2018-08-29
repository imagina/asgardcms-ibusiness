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
        //dd($request->all());
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
        $address=Address::create($addressData);
        $addressable=Addressables::create(['address_id'=>$address->id,'ibusiness__addressables_id'=>$business->id,"ibusiness__addressables_type"=>'Modules\Ibusiness\Entities\Business']);
        //dd($business,$address,$addressable);
        return redirect()->route('admin.ibusiness.business.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ibusiness::businesses.title.businesses')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Business $business
     * @return Response
     */
    public function edit(Business $business)
    {
      //dd($business);
      $test=Business::where('id',$business->id)->with('addresses')->first();
      dd($test);
      $businesses = $this->business->all();
      $branchOffices=Business::where('parent_id',$business->id)->get();
      return view('ibusiness::admin.businesses.edit', compact('business','businesses','branchOffices'));
    }

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

        return redirect()->route('admin.ibusiness.business.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibusiness::businesses.title.businesses')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Business $business
     * @return Response
     */
    public function destroy(Business $business)
    {
        $this->business->destroy($business);

        return redirect()->route('admin.ibusiness.business.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ibusiness::businesses.title.businesses')]));
    }
}
