<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'invoiceId' => $this->invoice_id,
            'productId' => $this->product_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'taxRate' => $this->tax_rate
        ];
    }
}
