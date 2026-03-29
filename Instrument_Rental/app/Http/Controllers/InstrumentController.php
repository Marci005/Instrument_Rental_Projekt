<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function index()
    {
        return response()->json(
            Instrument::with('category', 'brand')->get()
        );
    }

    public function show(Instrument $instrument)
    {
        return response()->json(
            $instrument->load(['category', 'brand'])
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:instrument_categories,id',
            'brand_id'    => 'required|exists:instrument_brands,id',
            'condition'   => 'required|in:új,újszerű,használt,megkímélt,hibás',
            'title'       => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        $instrument = Instrument::create($data);

        return response()->json($instrument->load(['category', 'brand']), 201);


    }


    public function update(Request $request, Instrument $instrument)
    {
        $data = $request->validate([
            'category_id' => 'sometimes|required|exists:instrument_categories,id',
            'brand_id'    => 'sometimes|required|exists:instrument_brands,id',
            'condition'   => 'sometimes|required|in:új,újszerű,használt,megkímélt,hibás',
            'title'       => 'sometimes|required|string|max:100',
            'description' => 'sometimes|required|string',
        ]);

        $instrument->update($data);

        return response()->json($instrument->load(['category', 'brand']));
    }

    public function destroy(Instrument $instrument)
    {
        $instrument->delete();

        return response()->json(['message' => 'Hangszer sikeresen törölve.']);
    }
}
