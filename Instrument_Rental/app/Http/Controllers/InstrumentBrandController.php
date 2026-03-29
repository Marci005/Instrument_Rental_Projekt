<?php

namespace App\Http\Controllers;

use App\Models\InstrumentBrand;
use http\Message;
use Illuminate\Http\Request;

class InstrumentBrandController extends Controller
{
    public function index()
    {
        return response()->json(InstrumentBrand::all());
    }

    public function show(InstrumentBrand $instrumentBrand)
    {
        return response()->json($instrumentBrand);
    }

    public function update(Request $request, InstrumentBrand $instrumentBrand)
    {
        $data = $request->validate([
            'brand_name' => 'required|string|max:100',
            'brand_description' => 'nullable|string',
        ]);

        $instrumentBrand->update($data);

        return response()->json($instrumentBrand);
    }

    public function destroy(InstrumentBrand $instrumentBrand)
    {
        $instrumentBrand->delete();

        return response()->json(['message' => 'Brand deleted']);
    }


}
