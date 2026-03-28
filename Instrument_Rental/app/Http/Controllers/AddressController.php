<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{

    /**
     * GET /api/addresses
     * The logged-in user's data
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
}
