<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Cafe\CreateCafeRequest;
use App\Http\Requests\API\Cafe\UpdateCafeRequest;
use App\Models\Cafe;
use App\Models\Company;
use App\Services\Cafe\CreateCafe;
use App\Services\Cafe\UpdateCafe;
use App\Services\Cafe\SearchCafes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Http\Resources\Cafe\Cafe as CafeResource;
use Illuminate\Http\Request;

class CafeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show', 'search');
        $this->middleware('can:store,App/Models/Cafe')->only('store');
        $this->middleware('can:update,cafe')->only('update');
        $this->middleware('can:delete,cafe')->only('destroy');
    }

    /**
     * Displays the cafes for a company
     * @param Company $company
     * @return Response
     */
    public function index( Company $company )
    {
        $cafes = $company->cafes;

        return response()->json( CafeResource::collection( $cafes ) );
    }

    public function search( Request $request )
    {
        $searchCafes = new SearchCafes( $request->all() );
        $cafes      = $searchCafes->search();

        return CafeResource::collection( $cafes )->response();
    }

    /**
     * Display the specified cafe
     *
     * @param Company $company
     * @param Cafe $cafe
     *
     * @return JsonResponse
     */
    public function show( Company $company, Cafe $cafe )
    {
        return ( new CafeResource( $cafe->loadMissing('company' ) ) )->response();
    }

    /**
     * $request
     * Saves a cafe
     *
     * @param CreateCafeRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function store(CreateCafeRequest $request, Company $company)
    {
        $createCafe = new CreateCafe( $request->all(), $company );
        $newCafe    = $createCafe->save();

        return ( new CafeResource( $newCafe->loadMissing('company' ) ) )->response();
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
        $updateCafe = new UpdateCafe( $company, $cafe, $request->all() );
        $updateCafe->save();

        return response()->json( null, 204 );
    }

    /**
     * Remove the specified cafe from storage.
     *
     * @param Company $company
     * @param Cafe $cafe
     * @return Response
     * @throws \Exception
     */
    public function destroy( Company $company, Cafe $cafe)  {
        $cafe->delete();

        return response()->json( '', 204 );
    }
}
