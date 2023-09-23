<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $category = Category::orderBy('name', 'asc')->get();
        // return response($category);
        return CategoryResource::collection($category);
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
    public function store(StoreCategoryRequest $request)
    {
        //
        $category = Category::create([
            'name' => $request->name,
        ]);

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        request()->validate([
            'category_id' => 'required',
        ]);
        $id = request()->category_id;
        $findCategory = $category->whereId($id)->first();
        if ($findCategory) {
            $findCategory->items()->delete();
            $findCategory->delete();

            return response([
                'succes' => true,
                'message' => 'succes delete category',
            ], 200);
        } else {
            return response([
                'succes' => false,
                'message' => 'id not found',
            ], 404);
        }
    }
}