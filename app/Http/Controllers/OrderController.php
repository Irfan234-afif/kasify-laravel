<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Item;
use App\Models\ItemOrder;
use App\Models\Order;
use App\Models\Sales;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if (request()->has('length')) {
            $orders = $user->latest()->paginate(request()->length);

            return OrderResource::collection($orders);
        } else if (request()->has('today')) {
            $today = Carbon::now()->format('Y-m-d');
            $orders = $user->orders()->whereDate('order_at', $today)->get();

            return OrderResource::collection($orders);
        }
        $orders = $user->orders()->latest()->get();

        return OrderResource::collection($orders);
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
    public function store(StoreOrderRequest $request)
    {
        $user = auth()->user();
        // $sales = $user->sales;

        $total_price = 0;
        $revenue = 0;
        $profit = 0;

        $order = $user->orders()->create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'total_price' => 0,
            // 'order_at' => fake()->date,
        ]);


        foreach ($request->input('items') as $itemData) {
            $item = Item::find($itemData['id']);
            $quantity = $itemData['quantity'];
            $detail = $itemData['detail'];

            $item->stock -= $quantity;
            $item->save();

            // find total price
            $total_price += $item->selling_price;

            $revenue += floatval($item['selling_price']);
            $profit += floatval($item['selling_price']) - floatval($item['basic_price']);

            $order->items()->attach($item, [
                'quantity' => $quantity,
                'detail' => $detail,
            ]);
        }
        // return response($revenue);

        $order->total_price = $total_price;
        $order->save();
        $last_order_count = 0;
        if (count($user->sales) != 0) {
            $last_order_count = $user->sales()->latest()->get()->first()->order_count;
        }

        $sales = $user->sales()->create([
            'order_id' => $order->id,
            'order_count' => 1,
            'revenue' => $revenue,
            'profit' => $profit,
        ]);

        $sales->order_count += $last_order_count;
        $sales->save();



        return response(
            [
                'message' => 'succes',
                'data' => new OrderResource(Order::with('items')->latest()->get()->first()),
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order = Order::findOrFail($request->order_id);

        $order->update([
            'done_at' => $request->done_at,
        ]);

        return response([
            'message' => 'succes',
            'data' => $order,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}