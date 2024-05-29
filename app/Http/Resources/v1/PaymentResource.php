<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoiceId' => $this->invoice_id,
            'refId' => $this->ref_id,
            'amount' => $this->amount,
            'paymentDate' => $this->payment_date,
            'paymentMethod' => $this->payment_method,
        ];
    }
}
