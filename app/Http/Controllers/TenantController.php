<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TenantController extends Controller
{
   public function index()
   {
      $tenants = Tenant::all();

      return response()->json([
         'total' => count($tenants),
         'data' => count($tenants) > 0 ? $tenants : "There are no tenants"
      ]);
   }

   public function show(string $id)
   {
      $tenant = Tenant::where('id', $id)->first();

      return response()->json([
         'data' => $tenant
      ]);
   }

   public function store(Request $request)
   {
      $data = $request->validate([
         'no_ktp' => ['required', 'string'],
         'name' => ['required', 'string'],
         'date_of_birth' => ['required', 'date'],
         'email' => ['required'],
         'phone' => ['required', 'string'],
         'description' => ['required', 'string'],
      ]);

      $tenant = Tenant::create([
         'no_ktp' => $data['no_ktp'],
         'name' => $data['name'],
         'date_of_birth' => $data['date_of_birth'],
         'email' => $data['email'],
         'phone' => $data['phone'],
         'description' => $data['description'],
      ]);

      return response()->json([
         'message' => 'Tenant successfully created!',
         'data' => $tenant
      ], 201);
   }

   public function update(string $id, Request $request)
   {
      $data = $request->validate([
         'no_ktp' => ['required', 'string'],
         'name' => ['required', 'string'],
         'date_of_birth' => ['required', 'date'],
         'email' => ['required'],
         'phone' => ['required', 'string'],
         'description' => ['required', 'string'],
      ]);

      $tenant = Tenant::find($id);

      if (!$tenant) {
         return response()->json([
            'message' => 'Tenant not found!'
         ], 404);
      }

      $tenant->update($data);

      return response()->json([
         'message' => 'Tenant updated successfully!',
         'tenant' => $tenant
      ], 200);
   }

   public function destroy(string $id)
   {
      $tenant = Tenant::find($id);

      if (!$tenant) {
         return response()->json([
            'message' => 'Tenant not found!'
         ], 404);
      }

      $tenant->delete();

      return response()->json([
         'message' => 'Tenant deleted successfully!',
      ], 200);
   }
}
