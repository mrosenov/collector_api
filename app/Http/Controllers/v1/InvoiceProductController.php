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
        $item = InvoiceProduct::find($id);

        if (!$item) {
            return response()->json([
                'message' => 'Invoice product not found.',
                'status' => 404
            ], 404);
        }

        return new InvoiceProductResource($item);
    }

    public function update(UpdateInvoiceProductRequest $request, $id) {
        $item = InvoiceProduct::find($id);

        if (!$item) {
            return response()->json([
                'message' => 'Invoice product not found.',
                'status' => 404
            ], 404);
        }

        $item->update($request->all());

        return new InvoiceProductResource($item);
    }

    public function destroy($id) {
        $item = InvoiceProduct::find($id);

        if (!$item) {
            return response()->json([
                'message' => 'Invoice product not found.',
                'status' => 404
            ], 404);
        }

        $item->delete();

        return response()->json([
            'message' => 'Invoice product deleted successfully.',
            'status' => 200
        ], 200);
    }
}
