<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Company\CreateCompanyRequest;
use App\Http\Requests\API\Company\UpdateCompanyRequest;
use App\Models\Company;
use App\Http\Resources\Company\Company as CompanyResource;
use App\Services\Company\LikeCompany;
use App\Services\Company\UpdateCompany;
use App\Services\Company\CreateCompany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show', 'like');
        $this->middleware('can:store,App\Models\Company')->only('store');
        $this->middleware('can:update,company')->only('update');
        $this->middleware('can:delete,company')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $companies = Company::all();
        return response()->json( CompanyResource::collection( $companies ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCompanyRequest $request
     * @return Response
     */
    public function store(CreateCompanyRequest $request)
    {
        $createCompany = new CreateCompany( $request->all() );
        $newCompany = $createCompany->save();

        return response()->json( $newCompany, 201 );
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return Response
     */
    public function show(Company $company)
    {
        $company = new CompanyResource( $company );
        return  response()->json( $company, 200 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCompanyRequest $request
     * @param Company $company
     * @return Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $update_company = new UpdateCompany( $company, $request->all() );
        $update_company->save();

        $companies = Company::all();

        return response()->json( null, 204 );
    }

    /**
     * Toggle like
     * @param Company $company
     * @return JsonResponse
     */
    public function like( Company $company )
    {
        $likeCompany    = new LikeCompany( $company );
        $liked          = $likeCompany->toggle();

        return response()->json( $liked, 201 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return void
     * @throws \Exception
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return response()->json( '', 204 );
    }
}
