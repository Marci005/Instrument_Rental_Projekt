<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{

    /**
     * GET /api/addresses
     * The logged in user's data
     */
    public function index(Request $request){


        return response()->json($request->user()->addresses);
    }
}
