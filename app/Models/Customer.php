<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'vat',
        'phone',
        'email',
        'address',
        'city',
        'postCode',
        'country',
    ];

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }
}
