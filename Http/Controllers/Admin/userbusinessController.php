<?php

namespace Modules\Ibusiness\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Modules\Ibusiness\Entities\UserBusiness;
use Modules\Ibusiness\Http\Requests\CreateuserbusinessRequest;
use Modules\Ibusiness\Http\Requests\UpdateuserbusinessRequest;
use Modules\Ibusiness\Repositories\UserBusinessRepository;
use Modules\Ibusiness\Entities\Business;
use Modules\User\Entities\Sentinel\User;
use Modules\User\Repositories\Sentinel\SentinelUserRepository;
use Modules\Ibusiness\Repositories\BusinessRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class UserBusinessController extends AdminBaseController
{
    /**
     * @var userbusinessRepository
     */
    private $userbusiness;
    private $business;
    private $users;

    public function __construct(UserBusinessRepository $userbusiness,BusinessRepository $business,SentinelUserRepository $users)
    {
        parent::__construct();
        $this->business = $business;
        $this->userbusiness = $userbusiness;
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $userbusinesses=UserBusiness::with('business','user')->get();
        //$userbusinesses = $this->userbusiness->all();

        return view('ibusiness::admin.userbusinesses.index', compact('userbusinesses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $businesses = $this->business->companies();
      // dd($businesses);
      $users=$this->users->all();
      $array=array();
      foreach ($users as $user){
        $userBusinesses=UserBusiness::where('user_id',$user->id)->get();
        $businessName="";
        if(count($userBusinesses)>0){
          foreach($userBusinesses as $businessess){
            $Business=Business::where('id',$businessess->businesses_id)->first();
            if($businessName=="")
              $businessName.=$Business->name;
            else
              $businessName.=",".$Business->name;
          }//foreach
          $array=array_merge($array,[['user_id'=>$user->id,'user_fullname'=>$user->first_name.' '.$user->last_name." - ".$user->email,'business'=>$businessName]]);
        }else{
          $array=array_merge($array,[['user_id'=>$user->id,'user_fullname'=>$user->first_name.' '.$user->last_name." - ".$user->email,'business'=>$businessName]]);
        }
      }//foreach
      $users=$array;
      return view('ibusiness::admin.userbusinesses.create',compact('businesses','users'));
    }

    public function getBranchOffice($business_id){
      try {
        $branchOffice=$this->business->branchOffice($business_id);
        return response()->json(['success'=>1,'branchOffices'=>$branchOffice]);
      } catch (\Exception $e) {
          return response()->json(['success'=>0,'message'=>$e->getMessage()]);
      }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateuserbusinessRequest $request
     * @return Response
     */
    public function store(CreateUserBusinessRequest $request)
    {
      $users=explode(",",$request->users);
      $businesses_id;
      //$request->company,$request->branch_office if branch!=0 get company
      if($request->branch_office!=0)
        $businesses_id=$request->branch_office;
      else
        $businesses_id=$request->company;
      for($i=0;$i<count($users);$i++){
        $user_id=$users[$i];
        $userBusinesses=UserBusiness::where('user_id',$user_id)->where('businesses_id',$businesses_id)->first();
        if(count($userBusinesses)<=0)
        $this->userbusiness->create(["_token"=>$request->_token,"user_id"=>$user_id,"businesses_id"=>$businesses_id]);
      }
        return redirect()->route('admin.ibusiness.userbusiness.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ibusiness::userbusinesses.title.userbusinesses')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  business $id
     * @return Response
     */
    public function edit($id)
    {
        $business = $this->business->getById($id);
        return view('ibusiness::admin.userbusinesses.edit', compact('business'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  userbusiness $userbusiness
     * @param  UpdateuserbusinessRequest $request
     * @return Response
     */
    public function update(UserBusiness $userbusiness, UpdateUserBusinessRequest $request)
    {
        $this->userbusiness->update($userbusiness, $request->all());

        return redirect()->route('admin.ibusiness.userbusiness.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibusiness::userbusinesses.title.userbusinesses')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  userbusiness $userbusiness
     * @return Response
     */
    public function destroy($business_id,$user_id)
    {

        $business = $this->business->getById($business_id);
        $business->users()->detach($user_id);

        return redirect()->route('admin.ibusiness.userbusiness.edit', [$business->id])
        ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibusiness::userbusinesses.title.userbusinesses')]));

    }

    /**
     * Search Users Via Ajax Select 2.
     *
     * @param  q
     * @return users
     */
    public function searchUsers()
    {

        $data = array();
        $q = strtolower(Input::get('q'));
        $business_id = Input::get('business_id');

        $users = User::with(['roles','businesses'])
        ->select('id','first_name','last_name','email')
        ->where("first_name","like","%{$q}%")
        ->orWhere("last_name","like","%{$q}%")
        ->get();

        $data["data"] = $users;

        return response()->json($data);

    }


     /**
     * Add Users to Business (relation).
     *
     * @param  request
     * @return reedirect
     */
    public function addUsers(Request $request,$business_id){

      if($request->users_ids){

        $business = $this->business->getById($business_id);
        $business->users()->syncWithoutDetaching($request->users_ids);

      }

      return redirect()->route('admin.ibusiness.userbusiness.edit', [$business->id])
      ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibusiness::userbusinesses.title.userbusinesses')]));

    }

}
