<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Company\CreateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\Company\CreateCompany;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCompanyRequest $request
     * @return Response
     */
    public function store(CreateCompanyRequest $request)
    {
        $create_company = new CreateCompany( $request->all() );
        $newCompany = $create_company->save();

        return response()->json( $newCompany, 201 );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Company  $company
     * @return Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
