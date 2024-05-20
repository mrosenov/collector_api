<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'tax_rate'
    ];

    public function invoiceProducts() {
        return $this->hasMany(InvoiceProduct::class);
    }
}
