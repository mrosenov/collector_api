<?php

namespace App\Http\Controllers\v1;

use App\Filters\v1\CustomerFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreCustomerRequest;
use App\Http\Requests\v1\UpdateCustomerRequest;
use App\Http\Resources\v1\CustomerCollection;
use App\Http\Resources\v1\CustomerResource;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CustomerFilter();
        $filterItems = $filter->transform($request);

        $includeInvoices = $request->query('includeInvoices');

        $customers = Customer::where($filterItems);

        if ($includeInvoices) {
            $customers = $customers->with('invoices');
        }

        return new CustomerCollection($customers->paginate()->appends($request->query()));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        if (Customer::where('phone', $request->phone)->exists()) {
            return response()->json([
                'message' => 'Customer with such phone already exists.',
                'status' => 409
            ], 409);
        }

        if (Customer::where('vat', $request->vat)->exists()) {
            return response()->json([
                'message' => 'Customer with such VAT already exists.',
                'status' => 409
            ], 409);
        }

        if (Customer::where('email', $request->email)->exists()) {
            return response()->json([
                'message' => 'Customer with such email already exists.',
                'status' => 409
            ], 409);
        }

        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'message' => 'Customer not found.',
                'status' => 404
            ], 404);
        }

        $includeInvoices = $request->query('includeInvoices');

        if ($includeInvoices) {
            return new CustomerResource($customer->loadMissing('invoices'));
        }

        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'message' => 'Customer not found.',
                'status' => 404
            ], 404);
        }

        $customer->update($request->all());

        return response()->json([
            'message' => 'Customer successfully updated.',
            'status' => 202
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'message' => 'Customer not found.',
                'status' => 404
            ], 404);
        }

        $customer->delete();

        return response()->json([
            'message' => 'Customer deleted successfully.',
            'status' => 202
        ], 202);
    }
}
