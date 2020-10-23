<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Cafe\CreateCafeRequest;
use App\Http\Requests\API\Cafe\UpdateCafeRequest;
use App\Models\Cafe;
use App\Models\Company;
use App\Services\Cafe\CreateCafe;
use Illuminate\Http\Response;

class CafeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }

    /**
     * Displays the cafes for a company
     * @param Company $company
     * @return Response
     */
    public function index(Company $company)
    {

    }

    /**
     * Display the specified cafe
     *
     * @param Company $company
     * @param Cafe $cafe
     *
     * @return Response
     */
    public function show(Company $company, Cafe $cafe)
    {

    }

    /**
     * $request
     * Saves a cafe
     *
     * @param CreateCafeRequest $request
     * @param Company $company
     * @return Response
     */
    public function store(CreateCafeRequest $request, Company $company)
    {
        $createCafe = new CreateCafe( $request->all(), $company );

        $newCafe = $createCafe->save();

        return response()->json( $cafe, 201);
    }

    /**
     * Update a cafe to a company
     * @param UpdateCafeRequest $request
     * @param Company $company
     * @param Cafe $cafe
     * @return Response
     */
    public function update( UpdateCafeRequest $request, Company $company, Cafe $cafe )
    {

    }

    /**
     * Remove the specified cafe from storage.
     *
     * @param Company $company
     * @param Cafe $cafe
     * @return Response
     */
    public function destroy( Company $company, Cafe $cafe)  {

    }
}
