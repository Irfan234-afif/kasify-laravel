<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderDoneRequest;
use App\Http\Requests\UpdateOrderDoneRequest;
use App\Http\Resources\OrderDoneCollection;
use App\Http\Resources\OrderDoneResource;
use App\Http\Resources\OrderResource;
use App\Models\OrderDone;

class OrderDoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order_done = OrderDone::with('orders')->latest()->get();

        return OrderDoneResource::collection($order_done)->toArray(request());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderDoneRequest $request)
    {
        OrderDone::create(
            [
                'order_id' => $request->order_id,
            ]
        );

        $order_done = OrderDone::with('orders')->latest()->get();

        return OrderDoneResource::collection($order_done)->toArray($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDone $orderDone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderDone $orderDone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderDoneRequest $request, OrderDone $orderDone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDone $orderDone)
    {
        //
    }
}