<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StorePaymentMethodRequest;
use App\Http\Requests\v1\UpdatePaymentMethodRequest;
use App\Http\Resources\v1\PaymentMethodCollection;
use App\Http\Resources\v1\PaymentMethodResource;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PaymentMethodCollection(PaymentMethod::paginate()->appends(request()->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentMethodRequest $request)
    {
        return new PaymentMethodResource(PaymentMethod::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if (!$paymentMethod) {
            return response()->json([
                'message' => 'Payment Method not found.',
                'status' => 404
            ], 404);
        }

        return new PaymentMethodResource($paymentMethod);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentMethodRequest $request, $id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if (!$paymentMethod) {
            return response()->json([
                'message' => 'Payment Method not found.',
                'status' => 404
            ], 404);
        }

        $paymentMethod->update($request->all());

        return response()->json([
            'message' => 'Payment Method successfully updated.',
            'status' => 202
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if (!$paymentMethod) {
            return response()->json([
                'message' => 'Payment Method not found.',
                'status' => 404
            ], 404);
        }

        $paymentMethod->delete();

        return response()->json([
            'message' => 'Payment Method successfully deleted.',
            'status' => 202
        ], 202);
    }
}
