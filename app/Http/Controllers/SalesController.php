<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalesResource;
use App\Models\Sales;
use App\Http\Requests\StoreSalesRequest;
use App\Http\Requests\UpdateSalesRequest;
use Illuminate\Support\Carbon;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if (request()->has('today')) {
            $today = Carbon::now()->format('Y-m-d');
            $sales = $user->sales()->whereDate('created_at', $today)->first();
            if ($sales) {

                return new SalesResource($sales);
            } else {
                return response(
                    [
                        'message' => 'sales not found',
                        'data' => [],
                    ],
                    404,
                );
            }
        } else {

            $sales = $user->sales;
            return SalesResource::collection($sales);
        }
        // if (request()->has('user_id')) {
        //     $sales = Sales::whereId(request()->user_id);
        //     return new SalesResource($sales);
        // }else{

        // }
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
    public function store(StoreSalesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesRequest $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sales)
    {
        //
    }
}