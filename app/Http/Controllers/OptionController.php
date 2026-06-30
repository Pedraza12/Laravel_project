<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Http\Resources\OptionResource;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index(Request $request)
    {
        $relations = $request->has('include')
            ? explode(',', $request->input('include'))
            : [];

        return OptionResource::collection(
            Option::include($relations)->paginate()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'option_name' => 'required|string|max:255',
        ]);

        $option = Option::create($validated);

        return (new OptionResource($option))->response()->setStatusCode(201);
    }

    public function show(Request $request, Option $option)
    {
        $relations = $request->has('include')
            ? explode(',', $request->input('include'))
            : [];

        $option->load($relations);

        return new OptionResource($option);
    }

    public function update(Request $request, Option $option)
    {
        $validated = $request->validate([
            'option_name' => 'sometimes|string|max:255',
        ]);

        $option->update($validated);

        return new OptionResource($option);
    }

    public function destroy(Option $option)
    {
        $option->delete();

        return response()->json(['message' => 'Option deleted successfully'], 200);
    }
}
