<?php

namespace App\Http\Controllers\v1;

use App\Filters\v1\InvoiceFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreInvoiceRequest;
use App\Http\Requests\v1\UpdateInvoiceRequest;
use App\Http\Resources\v1\InvoiceCollection;
use App\Http\Resources\v1\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new InvoiceFilter();
        $filterItems = $filter->transform($request);

        $invoices = Invoice::where($filterItems);

        return new InvoiceCollection($invoices->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        $invoice = Invoice::create([
            'customer_id' => $request->input('customerId'),
            'total' => $request->input('total'),
            'status' => $request->input('status'),
            'billed_date' => $request->input('billedDate'),
            'paid_date' => $request->input('paidDate'),
        ]);

        foreach ($request->products as $product) {
            $invoice->products()->create([
                'product_id' => $product['productId'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'tax_rate' => $product['taxRate'],
            ]);
        }

        return new InvoiceResource($invoice->load('products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Invoice $invoice)
    {
        $includeCustomer = $request->query('includeCustomer');
        $includeProducts = $request->query('includeProducts');

        if ($includeCustomer && $includeProducts) {
            return new InvoiceResource($invoice->loadMissing(['customer', 'products']));
        }
        if ($includeCustomer) {
            return new InvoiceResource($invoice->loadMissing('customer'));
        }

        if ($includeProducts) {
            return new InvoiceResource($invoice->loadMissing('products'));
        }

        return new InvoiceResource($invoice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->all());

        return response(['message' => 'Invoice updated successfully.', 'status' => 200], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response(['message' => 'Invoice deleted successfully.', 'status' => 200], 200);
    }
}
