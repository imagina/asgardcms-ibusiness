<?php

namespace Modules\Ibusiness\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ibusiness\Entities\OrderApprovers;
use Modules\Ibusiness\Http\Requests\CreateOrderApproversRequest;
use Modules\Ibusiness\Http\Requests\UpdateOrderApproversRequest;
use Modules\Ibusiness\Repositories\OrderApproversRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class OrderApproversController extends AdminBaseController
{
    /**
     * @var OrderApproversRepository
     */
    private $orderapprovers;

    public function __construct(OrderApproversRepository $orderapprovers)
    {
        parent::__construct();

        $this->orderapprovers = $orderapprovers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$orderapprovers = $this->orderapprovers->all();

        return view('ibusiness::admin.orderapprovers.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ibusiness::admin.orderapprovers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateorderApproversRequest $request
     * @return Response
     */
    public function store(CreateOrderApproversRequest $request)
    {
        $this->orderapprovers->create($request->all());

        return redirect()->route('admin.ibusiness.orderapprovers.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ibusiness::orderapprovers.title.orderapprovers')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  orderApprovers $orderapprovers
     * @return Response
     */
    public function edit(OrderApprovers $orderapprovers)
    {
        return view('ibusiness::admin.orderapprovers.edit', compact('orderapprovers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  orderApprovers $orderapprovers
     * @param  UpdateorderApproversRequest $request
     * @return Response
     */
    public function update(OrderApprovers $orderapprovers, UpdateOrderApproversRequest $request)
    {
        $this->orderapprovers->update($orderapprovers, $request->all());

        return redirect()->route('admin.ibusiness.orderapprovers.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibusiness::orderapprovers.title.orderapprovers')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  orderApprovers $orderapprovers
     * @return Response
     */
    public function destroy(OrderApprovers $orderapprovers)
    {
        $this->orderapprovers->destroy($orderapprovers);

        return redirect()->route('admin.ibusiness.orderapprovers.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ibusiness::orderapprovers.title.orderapprovers')]));
    }
}
