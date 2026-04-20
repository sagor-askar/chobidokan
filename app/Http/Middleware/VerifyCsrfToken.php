<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $addHttpCookie=true;
    protected $except = [
        'order/success',
        'order/fail',
        'order/cancel',

        'designer/product/payment/success',
        'designer/product/payment/fail',
        'designer/product/payment/cancel',

        'designer/project/payment/success',
        'designer/project/payment/fail',
        'designer/project/payment/cancel',

        'refund/project/payment/success',
        'refund/project/payment/fail',
        'refund/project/payment/cancel',

        'purchase/success',
        'purchase/fail',
        'purchase/cancel',

        'subscription/success',
        'subscription/fail',
        'subscription/cancel',

        'cart/purchase/success',
    ];
}
