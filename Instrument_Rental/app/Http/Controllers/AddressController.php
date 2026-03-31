<?php

namespace App\Http\Controllers;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class AddressController extends Controller
{

    /**
     * GET /api/addresses
     * Returns all addresses belonging to the authenticated user.

     * @param Request $request
     * @return JsonResponse
     */

    public function index(Request $request)
    {
        return response()->json(
            $request->user()->addresses
        );
    }

    /**
     * GET /api/addresses/{address}
     * Returns a specific address if it belongs to the authenticated user.
     * Checks ownership before returning data to prevent unauthorized access to other users' addresses.
     * Returns 403 if the address belongs to a different user.
     *
     *
     * @param Request $request
     * @param Address $address
     * @return JsonResponse
     */

    public function show(Request $request, Address $address){
        if($address->user_id !== $request->user()->id){
            return response()->json(['message' => 'You do not have permission to view this address.'], 403);
        }
        return response()->json($address);
    }

    /**
     * POST /api/addresses
     * Creates a new address and assigns it to the authenticated user.
     * Validates the incoming data before storing.
     *
     * @param Request $request
     * @return JsonResponse
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

        // Create the address and link it to the authenticated user
        $address = $request->user()->addresses()->create($data);

        return response()->json($address, 201);
    }

    /**
     * PUT/PATCH /api/addresses/{address}
     * Updates an existing address if it belongs to the authenticated user.
     * Checks ownership before updating to prevent unauthorized modification of other users' addresses.
     *
     * @param Request $request
     * @param Address $address
     * @return JsonResponse
     */
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

    /**
     * DELETE /api/addresses/{address}
     * Deletes an address if it belongs to the authenticated user.
     * Checks ownership before deleting to prevent unauthorized removal of other users' addresses.
     * Returns 204 No Content on successful deletion.
     *
     * @param Request $request
     * @param Address $address
     * @return JsonResponse
     */

    public function destroy(Request $request, Address $address)
    {
        if($address->user_id !== $request->user()->id){
            return response()->json(['message' => 'You do not have permission to delete this address.'], 403);
        }

        $address->delete();

        return response()->json(['message'=>'Address Succesfully deleted', 204]);
    }
}
