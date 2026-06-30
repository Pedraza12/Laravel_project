<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Http\Resources\OrderDetailResource;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index(Request $request)
    {
        $relations = $request->has('include')
            ? explode(',', $request->input('include'))
            : [];

        return OrderDetailResource::collection(
            OrderDetail::include($relations)->paginate()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric',
            'sku' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $orderDetail = OrderDetail::create($validated);

        return (new OrderDetailResource($orderDetail))->response()->setStatusCode(201);
    }

    public function show(Request $request, OrderDetail $orderDetail)
    {
        $relations = $request->has('include')
            ? explode(',', $request->input('include'))
            : [];

        $orderDetail->load($relations);

        return new OrderDetailResource($orderDetail);
    }

    public function update(Request $request, OrderDetail $orderDetail)
    {
        $validated = $request->validate([
            'order_id' => 'sometimes|exists:orders,id',
            'product_id' => 'sometimes|exists:products,id',
            'price' => 'sometimes|numeric',
            'sku' => 'nullable|string|max:255',
            'quantity' => 'sometimes|integer|min:1',
        ]);

        $orderDetail->update($validated);

        return new OrderDetailResource($orderDetail);
    }

    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->delete();

        return response()->json(['message' => 'Order detail deleted successfully'], 200);
    }
}
