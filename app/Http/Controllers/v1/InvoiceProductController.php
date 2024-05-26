<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\InvoiceProductCollection;
use App\Models\InvoiceProduct;
use Illuminate\Http\Request;

class InvoiceProductController extends Controller
{
    public function index(Request $request) {
        return new InvoiceProductCollection(InvoiceProduct::paginate()->appends($request->query()));
    }
}
