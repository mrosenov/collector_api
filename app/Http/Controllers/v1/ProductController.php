<?php

namespace App\Http\Controllers\v1;

use App\Filters\v1\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreProductRequest;
use App\Http\Requests\v1\UpdateProductRequest;
use App\Http\Resources\v1\ProductCollection;
use App\Http\Resources\v1\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ProductFilter();
        $filterItems = $filter->transform($request);

        $products = Product::where($filterItems);
        return new ProductCollection($products->paginate());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        return new ProductResource(Product::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found.',
                'status' => 404
            ], 404);
        }

        return new ProductResource($product);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Payment not found.',
                'status' => 404
            ], 404);
        }

        $product->update($request->all());

        return response()->json([
            'message' => 'Product updated successfully.',
            'status' => 202
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Payment not found.',
                'status' => 404
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully.',
            'status' => 202
        ], 202);
    }
}
