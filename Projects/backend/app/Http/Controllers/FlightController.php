<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class FlightController extends Controller
{

    public function check(Request $request)
    {
        $exists = Voucher::where('flight_number', $request->flight_number)
            ->where('flight_date', $request->flight_date)
            ->exists();

        return response()->json([
            'has_assigned_vouchers' => $exists
        ]);
    }
}