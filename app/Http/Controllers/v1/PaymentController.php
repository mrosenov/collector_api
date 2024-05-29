<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StorePaymentRequest;
use App\Http\Requests\v1\UpdatePaymentRequest;
use App\Http\Resources\v1\PaymentCollection;
use App\Http\Resources\v1\PaymentResource;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PaymentCollection(Payment::paginate()->appends(request()->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        if (Payment::where('ref_id', $request->ref_id)->exists()) {
            return response()->json([
                'message' => 'Payment with such Ref ID already exists.',
                'status' => 409
            ], 409);
        }

        return new PaymentResource(Payment::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found.',
                'status' => 404
            ], 404);
        }

        return new PaymentResource($payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found.',
                'status' => 404
            ], 404);
        }

        $payment->update($request->all());

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
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found.',
                'status' => 404
            ], 404);
        }

        $payment->delete();

        return response()->json([
            'message' => 'Payment successfully deleted.',
            'status' => 202
        ], 202);
    }
}
