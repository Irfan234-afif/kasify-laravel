<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemCollection;
use App\Http\Resources\ItemResource;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Item $item)
    {
        if (request()->has('length')) {
            $user = auth()->user();
            $items = $user->item->latest()->paginate(request()->length);
            return ItemResource::collection($items);
        } else {
            // $items = Item::latest()->get();
            $items = auth()->user()->items()->latest()->get();
            return ItemResource::collection($items);
        }
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
    public function store(StoreItemRequest $request)
    {
        // if ($request->has('all')) {

        // }
        $user = auth()->user();
        $item = $user->items()->create([
            'name' => $request->name,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'code_product' => $request->code_product,
            'description' => $request->description,
            'basic_price' => $request->basic_price,
            'selling_price' => $request->selling_price,
        ]);

        return new ItemResource($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        request()->validate(
            [
                'item_id' => 'required',
            ]
        );
        //
        $item = auth()->user()->items;
        $findItem = $item->whereId(request()->item_id)->first();
        if ($findItem) {
            $findItem->delete();

            return response([
                'succes' => true,
                'message' => 'item deleted',
            ]);
        } else {
            return response([
                'succes' => false,
                'message' => 'item id not found',
            ], 404);
        }
    }
}