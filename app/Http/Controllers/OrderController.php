<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $relations = $request->has('include')
            ? explode(',', $request->input('include'))
            : [];

        return OrderResource::collection(
            Order::include($relations)->paginate()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'ammount' => 'required|numeric',
            'shipping_address' => 'nullable|string',
            'order_address' => 'nullable|string',
            'order_email' => 'nullable|email',
            'order_date' => 'nullable|date',
            'order_status' => 'nullable|string|max:50',
        ]);

        $order = Order::create($validated);

        return (new OrderResource($order))->response()->setStatusCode(201);
    }

    public function show(Request $request, Order $order)
    {
        $relations = $request->has('include')
            ? explode(',', $request->input('include'))
            : [];

        $order->load($relations);

        return new OrderResource($order);
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_id' => 'sometimes|exists:customers,id',
            'ammount' => 'sometimes|numeric',
            'shipping_address' => 'nullable|string',
            'order_address' => 'nullable|string',
            'order_email' => 'nullable|email',
            'order_date' => 'nullable|date',
            'order_status' => 'nullable|string|max:50',
        ]);

        $order->update($validated);

        return new OrderResource($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}
