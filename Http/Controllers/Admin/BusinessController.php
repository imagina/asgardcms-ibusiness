<?php

namespace Modules\Ibusiness\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ibusiness\Entities\Business;
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
        //$businesses = $this->business->all();

        return view('ibusiness::admin.businesses.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ibusiness::admin.businesses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBusinessRequest $request
     * @return Response
     */
    public function store(CreateBusinessRequest $request)
    {
        $this->business->create($request->all());

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
        return view('ibusiness::admin.businesses.edit', compact('business'));
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
