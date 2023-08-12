<?php

namespace App\Http\Controllers;

use App\Models\Coupon;

class CouponController extends Controller
{
    public function show($id)
    {
        $coupon = Coupon::where('id', '=', $id)->first();

        return view('coupon', [
            'coupon' => $coupon,
        ]);
    }
}
