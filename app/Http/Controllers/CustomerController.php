<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $relations = $request->has('include')
            ? explode(',', $request->input('include'))
            : [];

        return CustomerResource::collection(
            Customer::include($relations)->paginate()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:8',
            'full_name' => 'required|string|max:255',
            'billing_address' => 'nullable|string',
            'default_shipping_address' => 'nullable|string',
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $customer = Customer::create($validated);

        return (new CustomerResource($customer))->response()->setStatusCode(201);
    }

    public function show(Request $request, Customer $customer)
    {
        $relations = $request->has('include')
            ? explode(',', $request->input('include'))
            : [];

        $customer->load($relations);

        return new CustomerResource($customer);
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'email' => 'sometimes|email|unique:customers,email,' . $customer->id,
            'password' => 'sometimes|string|min:8',
            'full_name' => 'sometimes|string|max:255',
            'billing_address' => 'nullable|string',
            'default_shipping_address' => 'nullable|string',
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $customer->update($validated);

        return new CustomerResource($customer);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }
}
