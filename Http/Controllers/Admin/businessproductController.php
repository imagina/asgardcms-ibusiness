<?php

namespace Modules\Ibusiness\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ibusiness\Entities\businessproduct;
use Modules\Ibusiness\Http\Requests\CreatebusinessproductRequest;
use Modules\Ibusiness\Http\Requests\UpdatebusinessproductRequest;
use Modules\Ibusiness\Repositories\businessproductRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class businessproductController extends AdminBaseController
{
    /**
     * @var businessproductRepository
     */
    private $businessproduct;

    public function __construct(businessproductRepository $businessproduct)
    {
        parent::__construct();

        $this->businessproduct = $businessproduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$businessproducts = $this->businessproduct->all();

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
    public function edit(businessproduct $businessproduct)
    {
        return view('ibusiness::admin.businessproducts.edit', compact('businessproduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  businessproduct $businessproduct
     * @param  UpdatebusinessproductRequest $request
     * @return Response
     */
    public function update(businessproduct $businessproduct, UpdatebusinessproductRequest $request)
    {
        $this->businessproduct->update($businessproduct, $request->all());

        return redirect()->route('admin.ibusiness.businessproduct.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibusiness::businessproducts.title.businessproducts')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  businessproduct $businessproduct
     * @return Response
     */
    public function destroy(businessproduct $businessproduct)
    {
        $this->businessproduct->destroy($businessproduct);

        return redirect()->route('admin.ibusiness.businessproduct.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ibusiness::businessproducts.title.businessproducts')]));
    }
}
