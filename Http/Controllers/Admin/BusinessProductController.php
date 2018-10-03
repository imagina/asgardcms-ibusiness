<?php

namespace Modules\Ibusiness\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Modules\Ibusiness\Entities\BusinessProduct;
use Modules\Ibusiness\Http\Requests\CreateBusinessProductRequest;
use Modules\Ibusiness\Http\Requests\UpdateBusinessProductRequest;
use Modules\Ibusiness\Repositories\BusinessProductRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Ibusiness\Repositories\BusinessRepository;
use Modules\Icommerce\Entities\Product;
use Modules\Icommerce\Repositories\ProductRepository;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Ibusiness\Jobs\BulkloadProductPrice;

class BusinessProductController extends AdminBaseController
{
    /**
     * @var businessproductRepository
     */
    private $businessproduct;
    private $business;
    private $product;

    public function __construct(BusinessProductRepository $businessproduct,BusinessRepository $business,ProductRepository $product)
    {
        parent::__construct();
        $this->business = $business;
        $this->product = $product;
        $this->businessproduct = $businessproduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // $businessproducts = $this->businessproduct->all();

        return view('ibusiness::admin.businessproducts.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ibusiness::admin.businessproducts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatebusinessproductRequest $request
     * @return Response
     */
    public function store(CreatebusinessproductRequest $request)
    {
        $this->businessproduct->create($request->all());

        return redirect()->route('admin.ibusiness.businessproduct.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ibusiness::businessproducts.title.businessproducts')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  businessproduct $businessproduct
     * @return Response
     */
    public function edit($id)
    {
        $business = $this->business->getById($id);
        $businessproducts = $this->businessproduct->all();
        // dd($businessproducts);
        return view('ibusiness::admin.businessproducts.edit', compact('business'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  businessproduct $businessproduct
     * @param  UpdatebusinessproductRequest $request
     * @return Response
     */
    public function update(BusinessProduct $businessproduct, UpdatebusinessproductRequest $request)
    {

        $this->businessproduct->update($businessproduct, $request->all());

        return redirect()->route('admin.ibusiness.businessproduct.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibusiness::businessproducts.title.businessproducts')]));
    }

    public function importProduct(Request $request,$id){
      $businessproducts = $this->businessproduct->all();
      //$id = business_id
      //$request->importfile == excel file
      // dd($request->all());
      $data_excel = Excel::Load($request->importfile, function ($reader) {
          $excel = $reader->all();
          return $excel;
      });
      $data_excel=$data_excel->parsed;
      // dd($data_excel);
      BulkloadProductPrice::dispatch(json_decode($data_excel),$id,$this->business);
      // foreach (json_decode($data_excel) as $i){
      //   dd($i);
      //   echo $i->price;
      //   //$i->price
      //   //$i->product_id
      // }
      return redirect()->back()->withSuccess(trans('ibusiness::businessproducts.messages.success migrate from product'));
      // return redirect()->route('admin.ibusiness.businessproduct.importproduct');
    }

    public function importProductTrapeq(Request $request){
      dd('asddad',$request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  businessproduct $businessproduct
     * @return Response
     */
    public function destroy($business_id,$product_id)
    {
        // dd($business_id,$product_id);
        $businessProduct=$this->businessproduct->relationProduct($business_id,$product_id);
        $businessProduct->delete();
        // $this->businessproduct->destroy($businessproduct);

        return redirect()->route('admin.ibusiness.businessproduct.edit',[$business_id])
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ibusiness::businessproducts.title.businessRelationProduct')]));
    }

     /**
     * Search Users Via Ajax Select 2.
     *
     * @param  q
     * @return products
     */
    public function searchProducts()
    {

        $data = array();
        $q = strtolower(Input::get('q'));
        $business_id = Input::get('business_id');
        $products = Product::with(['businesses'])
        ->select('id','title','sku')
        ->where("title","like","%{$q}%")
        ->orWhere("description","like","%{$q}%")
        ->orWhere("sku","like","%{$q}%")
        ->get();
        $data["data"] = $products;
        return response()->json($data);
    }//searchProducts()

     /**
     * Add Products to Business (relation).
     *
     * @param  request
     * @return reedirect
     */
    public function addProducts(Request $request,$business_id){


        if($request->products_ids){
            $products = $this->product->find($request->products_ids);
            $p = array();

            foreach($products as $product){
                $p[$product->id] = ["price"=>$product->price];
            }

            $business = $this->business->getById($business_id);
            $business->products()->syncWithoutDetaching($p);

        }

        return redirect()->route('admin.ibusiness.businessproduct.edit', [$business->id])
        ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibusiness::businessproducts.title.businessproducts')]));

    }//addProducts()

     /**
     * Search Products Via Ajax DataTable.
     *
     * @param  req
     * @return DataTable Format
     */

    public function searchTable(Request $request,$business_id)
    {
        $query = Product::select('icommerce__products.id', 'icommerce__products.title', 'icommerce__products.sku', 'ibusiness__businessproducts.price','icommerce__products.status', 'ibusiness__businessproducts.created_at', 'icommerce__products.stock_status')
            ->leftJoin('ibusiness__businessproducts','icommerce__products.id','=','ibusiness__businessproducts.product_id')
            ->leftJoin('ibusiness__businesses','ibusiness__businessproducts.product_id','=','ibusiness__businesses.id')
            ->where('ibusiness__businessproducts.business_id','=',$business_id);
        return datatables($query)->make(true);
    }
    public function getProduct(Request $request){
      try {
        $businessProduct=$this->businessproduct->relationProduct($request->business_id,$request->product_id);
        return response()->json(['success'=>1,'data'=>$businessProduct]);
      } catch (\Exception $e) {
        return response()->json(['success'=>0,'msg'=>$e->getMessage()]);
      }
    }//getProduct()

    public function updatePriceProduct(Request $request){
      try {
        $businessProduct=BusinessProduct::where('business_id',$request->business_id)->where('product_id',$request->product_id)->first();
        $business = $this->business->getById($request->business_id);
        $business->products()->updateExistingPivot($request->product_id,['price'=>$request->price]);
        return response()->json(['success'=>1,'msg'=>trans('ibusiness::businessproducts.messages.product_price_update')]);
      } catch (\Exception $e) {
        return response()->json(['success'=>0,'msg'=>$e->getMessage()]);
      }
    }//updatePriceProduct

}
