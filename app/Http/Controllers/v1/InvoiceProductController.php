<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreInvoiceProductRequest;
use App\Http\Requests\v1\UpdateInvoiceProductRequest;
use App\Http\Resources\v1\InvoiceProductCollection;
use App\Http\Resources\v1\InvoiceProductResource;
use App\Models\InvoiceProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceProductController extends Controller
{
    public function index(Request $request) {
        return new InvoiceProductCollection(InvoiceProduct::paginate()->appends($request->query()));
    }

    public function store(StoreInvoiceProductRequest $request) {
        return new InvoiceProductResource(InvoiceProduct::create($request->all()));
    }

    public function show($id)
    {
        $product = InvoiceProduct::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Invoice Product not found.',
                'status' => 404
            ], 404);
        }

        return new InvoiceProductResource($product);
    }

    public function update(UpdateInvoiceProductRequest $request, $id) {
        $product = InvoiceProduct::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Invoice Product not found.',
                'status' => 404
            ], 404);
        }

        $product->update($request->all());

        return response()->json([
            'message' => 'Invoice Product successfully updated.',
            'status' => 202
        ], 202);
    }

    public function destroy($id) {
        $product = InvoiceProduct::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Invoice Product not found.',
                'status' => 404
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Invoice Product successfully deleted.',
            'status' => 202
        ], 202);
    }
}
