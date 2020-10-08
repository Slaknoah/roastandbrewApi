<?php


namespace App\Services\Company;

use App\Models\Company;
use App\Models\User;
class CreateCompany
{
    private $data;

    public function __construct( $newCompanyData )
    {
        $this->data = $newCompanyData;
    }

    public function save()
    {
        $user = User::findOrFail( auth()->id() );
        $company = $user->companies()->create( $this->data );

        return $company;
    }
}
