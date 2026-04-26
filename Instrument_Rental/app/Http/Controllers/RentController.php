<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    /**
     * GET /api/rents
     * Returns the rents of the currently authenticated user.
     */
    public function index(Request $request)
    {
        return response()->json(
            $request->user()->rents()->with('instrument')->get()
        );
    }

    /**
     * GET /api/rents/{rent}
     * Returns a specific rent.
     * Access: owner of the rent OR any admin.
     */
    public function show(Request $request, Rent $rent)
    {
        if (!$this->canAccess($request, $rent)) {
            return response()->json(['message' => 'Hozzáférés megtagadva.'], 403);
        }

        return response()->json($rent->load('instrument'));
    }

    /**
     * POST /api/rents
     * Creates a new rent for the authenticated user.
     */
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

    /**
     * PUT/PATCH /api/rents/{rent}
     * Updates an existing rent.
     * Access: owner of the rent OR any admin.
     */
    public function update(Request $request, Rent $rent)
    {
        if (!$this->canAccess($request, $rent)) {
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

    /**
     * DELETE /api/rents/{rent}
     * Deletes a rent.
     * Access: owner of the rent OR any admin.
     */
    public function destroy(Request $request, Rent $rent)
    {
        if (!$this->canAccess($request, $rent)) {
            return response()->json(['message' => 'Hozzáférés megtagadva.'], 403);
        }

        $rent->delete();

        return response()->json(['message' => 'Bérlés sikeresen törölve.']);
    }

    /**
     * Checks whether the current user can access the given rent.
     * Access is granted when the user owns the rent OR when the user is an admin.
     */
    private function canAccess(Request $request, Rent $rent): bool
    {
        $user = $request->user();

        if ($user === null) {
            return false;
        }

        return $rent->user_id === $user->id || (int) $user->is_admin === 1;
    }
}
