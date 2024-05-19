<?php

namespace App\Filters\v1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class ProductFilter extends ApiFilter {
    protected $safeParms = [
        'name' => ['eq'],
        'price' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'taxRate' => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];

    protected $columnMap = [
        'taxRate' => 'tax_rate'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];
}
