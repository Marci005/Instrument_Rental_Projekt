<?php

namespace App\Http\Controllers;

use App\Models\InstrumentCategory;
use Illuminate\Http\Request;

class InstrumentCategoryController extends Controller
{
    public function index()
    {
        return response()->json(InstrumentCategory::all());
    }

    public function show(InstrumentCategory $instrumentCategory)
    {
        return response()->json($instrumentCategory->load('instruments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_name' => 'required|string|max:100',
            'category_description' => 'nullable|string',
        ]);

        $category = InstrumentCategory::create($data);

        return response()->json($category, 201);

    }

    public function update(Request $request, InstrumentCategory $instrumentCategory)
    {
        $data = $request->validate([
            'category_name' => 'sometimes|required|string|max:100',
            'category_description' => 'nullable|string',
        ]);

        $instrumentCategory->update($data);

        return response()->json($instrumentCategory);
    }

    public function destroy(InstrumentCategory $instrumentCategory)
    {
        $instrumentCategory->delete();

        return response()->json(['message' => 'Kategória törölve']);
    }


}
