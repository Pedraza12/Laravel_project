<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $relations = $request->has('include')
            ? explode(',', $request->input('include'))
            : [];

        return CategoryResource::collection(
            Category::include($relations)->paginate()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:255',
        ]);

        $category = Category::create($validated);

        return (new CategoryResource($category))->response()->setStatusCode(201);
    }

    public function show(Request $request, Category $category)
    {
        $relations = $request->has('include')
            ? explode(',', $request->input('include'))
            : [];

        $category->load($relations);

        return new CategoryResource($category);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:255',
        ]);

        $category->update($validated);

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
