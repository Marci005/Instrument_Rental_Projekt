<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InstrumentController extends Controller
{
    /**
     * GET /api/instruments
     * Returns all instruments with their category and brand.
     */
    public function index()
    {
        return response()->json(
            Instrument::with('category', 'brand')->get()
        );
    }

    /**
     * GET /api/instruments/{instrument}
     * Returns a specific instrument with its category and brand.
     */
    public function show(Instrument $instrument)
    {
        return response()->json(
            $instrument->load(['category', 'brand'])
        );
    }

    /**
     * POST /api/instruments
     * Creates a new instrument. Admin-only endpoint.
     *
     * Supports optional image upload via multipart/form-data. When provided,
     * the image is saved under public/images/instruments/ and the relative
     * path is stored in the database.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'   => 'required|exists:instrument_categories,id',
            'brand_id'      => 'required|exists:instrument_brands,id',
            'condition'     => 'required|in:Új,Újszerű,Használt',
            'title'         => 'required|string|max:100',
            'description'   => 'nullable|string',
            'monthly_price' => 'required|integer|min:0',
            'deposit'       => 'required|integer|min:0',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Optional image upload handling
        if ($request->hasFile('image')) {
            $data['image'] = $this->storeUploadedImage($request->file('image'));
        }

        $instrument = Instrument::create($data);

        return response()->json($instrument->load(['category', 'brand']), 201);
    }

    /**
     * PUT/PATCH /api/instruments/{instrument}
     * Updates an existing instrument. Admin-only endpoint.
     */
    public function update(Request $request, Instrument $instrument)
    {
        $data = $request->validate([
            'category_id'   => 'sometimes|required|exists:instrument_categories,id',
            'brand_id'      => 'sometimes|required|exists:instrument_brands,id',
            'condition'     => 'sometimes|required|in:Új,Újszerű,Használt',
            'title'         => 'sometimes|required|string|max:100',
            'description'   => 'nullable|string',
            'monthly_price' => 'sometimes|required|integer|min:0',
            'deposit'       => 'sometimes|required|integer|min:0',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeUploadedImage($request->file('image'));
        }

        $instrument->update($data);

        return response()->json($instrument->load(['category', 'brand']));
    }

    /**
     * DELETE /api/instruments/{instrument}
     * Deletes an instrument. Admin-only endpoint.
     */
    public function destroy(Instrument $instrument)
    {
        $instrument->delete();

        return response()->json(['message' => 'Hangszer sikeresen törölve.']);
    }

    /**
     * Saves an uploaded image to public/images/instruments/ and
     * returns the relative path suitable for the DB and frontend.
     *
     * Filename pattern: <slug>_<timestamp>.<ext>
     */
    private function storeUploadedImage($file): string
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $slug = Str::slug($originalName) ?: 'instrument';
        $extension = $file->getClientOriginalExtension();
        $filename = $slug . '_' . time() . '.' . $extension;

        $targetDir = public_path('images/instruments');

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $filename);

        return 'images/instruments/' . $filename;
    }
}
