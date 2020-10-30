<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\BrewMethod;

class BrewMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin')->only(['store', 'update', 'destroy']);
    }

    public function index() {
        $brew_methods = BrewMethod::all();

        return response()->json( $brew_methods );
    }

    /**
     * Store Brew method
     */
    public function store()
    {

    }

    /**
     * Update Brew method
     */
    public function update()
    {

    }

    /**
     * Delete Brew method
     */
    public function destroy()
    {

    }
}

