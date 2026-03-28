<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{

    /**
     * GET /api/addresses
     * The logged-in user's data
     * @param Request $request
     * return
     */
    public function index(Request $request)
    {
        return response()->json(
            $request->user()->addresses
        );
    }

    /**
     * Display a specific address belonging to the authenticated user.
     *
     * This method ensures that the requested Address model instance
     * actually belongs to the logged‑in user. If not, a 403 Forbidden
     * JSON response is returned.
     *
     * @param \Illuminate\Http\Request $request  The incoming HTTP request.
     * @param \App\Models\Address      $address  The address instance resolved via route model binding.
     *
     * @return \Illuminate\Http\JsonResponse     The address data or a 403 error message.
     */
    public function show(Request $request, Address $address){
        if($address->user_id !== $request->user()->id){
            return response()->json(['message' => 'You do not have permission to view this address.'], 403);
        }
        return response()->json($address);
    }

    /**
     * POST /api/addresses
     * The logged-in user stores new data to his record
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'address_type' => 'required|in:számlázási,szállítási,mindkettő',
            'zip' => 'required|string|max:50',
            'settlement' => 'required|string|max:100',
            'street' => 'required|string|max:100',
            'street_type' => 'required|string|max:30',
            'house_number' => 'required|string|max:100',
        ]);

        $address = $request->user()->addresses()->create($data);

        return response()->json($address, 201);
    }

    public function update(Request $request, Address $address)
    {
        if($address->user_id !== $request->user()->id){
            return response()->json(['message' => 'You do not have permission to update this address.'], 403);
        }
        $data = $request->validate([
            'address_type' => 'required|in:számlázási,szállítási,mindkettő',
            'zip' => 'required|string|max:50',
            'settlement' => 'required|string|max:100',
            'street' => 'required|string|max:100',
            'street_type' => 'required|string|max:30',
            'house_number' => 'required|string|max:100',
        ]);

        $address->update($data);

        return response()->json($address);
    }
}
