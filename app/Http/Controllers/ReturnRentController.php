<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\ReturnRent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReturnRentController extends Controller
{
    public function index()
    {
        $returnRent = ReturnRent::all();

        return response()->json([
            'total' => count($returnRent),
            'data' => count($returnRent) > 0 ? $returnRent : "There are no car return"
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

        $returnRent = ReturnRent::create([
            'tenant_id' => $data['tenant_id'],
            'penalty_id' => null,
            'no_car' => $data['no_car'],
            'date_borrow' => Carbon::parse($data['date_borrow'])->format('Y-m-d'),
            'date_return' => Carbon::parse($data['date_return'])->format('Y-m-d'),
            'down_payment' => $data['down_payment'],
            'discount' => $data['discount'] ?? 0,
            'total' => $total ?? 0
        ]);

        return response()->json([
            'message' => 'Return created successfully!',
            'data' => $returnRent
        ], 201);
    }

    public function show(string $id)
    {
        $returnRent = ReturnRent::where('id', $id)->first();

        if (!$returnRent) {
            return response()->json([
                'message' => "Return not found!"
            ], 404);
        }

        return response()->json([
            'data' => $returnRent
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

        $returnRent = ReturnRent::find($id);

        if (!$returnRent) {
            return response()->json([
                'message' => 'Return not found!',
            ], 404);
        }

        $discount = $data['discount'] ?? 0;
        $discountPrice = $data['down_payment'] * ($discount / 100);
        $data['total'] = $data['down_payment'] - $discountPrice;

        $returnRent->update($data);

        return response()->json([
            'message' => 'Return created successfully!',
            'data' => $returnRent
        ], 201);
    }


    public function destroy(string $id)
    {
        $returnRent = ReturnRent::find($id);

        if (!$returnRent) {
            return response()->json([
                'message' => 'Return not found!'
            ], 404);
        }

        $returnRent->delete();

        return response()->json([
            "message" => 'Return deleted successfully!'
        ]);
    }
}
