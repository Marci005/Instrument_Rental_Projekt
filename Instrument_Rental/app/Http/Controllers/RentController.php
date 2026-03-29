<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            $request->user()->rents()->with('instrument')->get()
        );
    }

    public function show(Request $request, Rent $rent)
    {
        if ($rent->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Hozzáférés megtagadva.'], 403);
        }

        return response()->json($rent->load('instrument'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'instrument_id' => 'required|exists:instruments,id',
            'rent_price'    => 'required|integer|min:0',
            'start_date'    => 'required|date|after_or_equal:today',
            'end_date'      => 'nullable|date|after:start_date',
            'real_end_date' => 'nullable|date',
        ]);

        $data['user_id'] = $request->user()->id;

        $rent = Rent::create($data);

        return response()->json($rent->load('instrument'), 201);
    }

    public function update(Request $request, Rent $rent)
    {
        if ($rent->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Hozzáférés megtagadva.'], 403);
        }

        $data = $request->validate([
            'instrument_id' => 'sometimes|required|exists:instruments,id',
            'rent_price'    => 'sometimes|required|integer|min:0',
            'start_date'    => 'sometimes|required|date',
            'end_date'      => 'nullable|date|after:start_date',
            'real_end_date' => 'nullable|date',
        ]);

        $rent->update($data);

        return response()->json($rent->load('instrument'));
    }

    public function destroy(Request $request, Rent $rent)
    {
        if ($rent->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Hozzáférés megtagadva.'], 403);
        }

        $rent->delete();

        return response()->json(['message' => 'Bérlés sikeresen törölve.']);
    }


}
