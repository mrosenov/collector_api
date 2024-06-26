<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'total', 'status', 'billed_date', 'paid_date'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function products() {
        return $this->hasMany(InvoiceProduct::class);
    }
}
