<?php

namespace Modules\Ibusiness\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ibusiness\Entities\Order_Approvers;
use Modules\Ibusiness\Http\Requests\CreateOrder_ApproversRequest;
use Modules\Ibusiness\Http\Requests\UpdateOrder_ApproversRequest;
use Modules\Ibusiness\Repositories\Order_ApproversRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class Order_ApproversController extends AdminBaseController
{
    /**
     * @var Order_ApproversRepository
     */
    private $order_approvers;

    public function __construct(Order_ApproversRepository $order_approvers)
    {
        parent::__construct();

        $this->order_approvers = $order_approvers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$order_approvers = $this->order_approvers->all();

        return view('ibusiness::admin.order_approvers.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ibusiness::admin.order_approvers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateOrder_ApproversRequest $request
     * @return Response
     */
    public function store(CreateOrder_ApproversRequest $request)
    {
        $this->order_approvers->create($request->all());

        return redirect()->route('admin.ibusiness.order_approvers.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ibusiness::order_approvers.title.order_approvers')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Order_Approvers $order_approvers
     * @return Response
     */
    public function edit(Order_Approvers $order_approvers)
    {
        return view('ibusiness::admin.order_approvers.edit', compact('order_approvers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Order_Approvers $order_approvers
     * @param  UpdateOrder_ApproversRequest $request
     * @return Response
     */
    public function update(Order_Approvers $order_approvers, UpdateOrder_ApproversRequest $request)
    {
        $this->order_approvers->update($order_approvers, $request->all());

        return redirect()->route('admin.ibusiness.order_approvers.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ibusiness::order_approvers.title.order_approvers')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Order_Approvers $order_approvers
     * @return Response
     */
    public function destroy(Order_Approvers $order_approvers)
    {
        $this->order_approvers->destroy($order_approvers);

        return redirect()->route('admin.ibusiness.order_approvers.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ibusiness::order_approvers.title.order_approvers')]));
    }
}
