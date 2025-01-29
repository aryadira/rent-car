<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{

    public function index()
    {
        $rents = Rent::all();

        return response()->json([
            'total' => count($rents),
            'data' => count($rents) > 0 ? $rents : "There are no rents"
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tenant_id' => ['required', 'exists:tenants,id'],
            'no_car' => ['required'],
            'date_borrow' => ['required', 'date'],
            'date_return' => ['nullable', 'date', 'after:date_borrow'],
            'down_payment' => ['required', 'numeric'],
            'discount' => ['nullable', 'numeric'],
        ]);

        $discountPrice = $data['down_payment'] * ($data['discount'] / 100);

        $total = $data['down_payment'] - $discountPrice;

        $rent = Rent::create([
            'tenant_id' => $data['tenant_id'],
            'no_car' => $data['no_car'],
            'date_borrow' => Carbon::parse($data['date_borrow'])->format('Y-m-d'),
            'date_return' => Carbon::parse($data['date_return'])->format('Y-m-d'),
            'down_payment' => $data['down_payment'],
            'discount' => $data['discount'] ?? 0,
            'total' => $total ?? 0
        ]);

        return response()->json([
            'message' => 'Rent created successfully!',
            'data' => $rent
        ], 201);
    }


    public function show(string $id)
    {
        $rent = Rent::where('id', $id)->first();

        if (!$rent) {
            return response()->json([
                'message' => "Rent not found!"
            ], 404);
        }

        return response()->json([
            'data' => $rent
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'no_car' => ['required'],
            'date_borrow' => ['required', 'date'],
            'date_return' => ['nullable', 'date', 'after:date_borrow'],
            'down_payment' => ['required', 'numeric'],
            'discount' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        $rent = Rent::find($id);

        if (!$rent) {
            return response()->json([
                'message' => 'Rent not found!',
            ], 404);
        }

        $discount = $data['discount'] ?? 0;
        $discountPrice = $data['down_payment'] * ($discount / 100);
        $data['total'] = $data['down_payment'] - $discountPrice;

        $rent->update($data);

        return response()->json([
            'message' => 'Rent created successfully!',
            'data' => $rent
        ], 201);
    }


    public function destroy(string $id)
    {
        $rent = Rent::find($id);

        if (!$rent) {
            return response()->json([
                'message' => 'Rent not found!'
            ], 404);
        }

        $rent->delete();

        return response()->json([
            "message" => 'Rent deleted successfully!'
        ]);
    }
}
