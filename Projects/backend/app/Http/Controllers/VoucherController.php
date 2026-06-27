<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Services\SeatGeneratorService;
use Illuminate\Http\Request;
use Exception;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $passengers = Voucher::orderBy('created_at', 'desc')->get();

        return response()->json($passengers, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function __construct(
        private SeatGeneratorService $seatGenerator
    ) {
    }

    public function store(Request $request)
    {
        $request->validate([
            'crew_name' => 'required',
            'crew_id' => 'required',
            'flight_number' => 'required',
            'flight_date' => 'required|date',
            'aircraft_type' => 'required',
        ]);

        try {
            $seat = $this->seatGenerator->generateSeat( $request->aircraft_type);

            $voucher = Voucher::create([
                'crew_name' => $request->crew_name,
                'crew_id' => $request->crew_id,
                'flight_number' => $request->flight_number,
                'flight_date' => $request->flight_date,
                'aircraft_type' => $request->aircraft_type,
                'seat1' => $seat[0],
                'seat2' => $seat[1],
                'seat3' => $seat[2],
            ]);

            return response()->json([
            'seat1' => $voucher->seat1,
            'seat2' => $voucher->seat2,
            'seat3' => $voucher->seat3,
            ], 201);
        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 400);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, voucher $voucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(voucher $voucher)
    {
        //
    }
}
