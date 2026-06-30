<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $relations = $request->has('include')
            ? explode(',', $request->input('include'))
            : [];

        return ProductResource::collection(
            Product::include($relations)->paginate()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku' => 'required|string|unique:products,sku|max:255',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'weight' => 'nullable|numeric',
            'descriptions' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'create_date' => 'nullable|date',
            'stock' => 'nullable|integer|min:0',
        ]);

        $product = Product::create($validated);

        return (new ProductResource($product))->response()->setStatusCode(201);
    }

    public function show(Request $request, Product $product)
    {
        $relations = $request->has('include')
            ? explode(',', $request->input('include'))
            : [];

        $product->load($relations);

        return new ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'sku' => 'sometimes|string|unique:products,sku,' . $product->id . '|max:255',
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'weight' => 'nullable|numeric',
            'descriptions' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'create_date' => 'nullable|date',
            'stock' => 'nullable|integer|min:0',
        ]);

        $product->update($validated);

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
