<?php


namespace App\Services\Company;

use Illuminate\Support\Facades\Auth;

class UpdateCompany
{
    private $data;
    private $company;

    public function __construct( $company, $companyData )
    {
        $this->company = $company;
        $this->data = $companyData;
    }

    public function save()
    {
        return $this->persistUpdates();
    }

    private function persistUpdates()
    {
        $this->company->name          = $this->data['name'];
        $this->company->roaster       = $this->data['roaster'];
        $this->company->subscription  = $this->data['subscription'];
        $this->company->description   = $this->data['description'];
        $this->company->website       = $this->data['website'];
        $this->company->address       = $this->data['address'];
        $this->company->city          = $this->data['city'];
        $this->company->state         = $this->data['state'];
        $this->company->zip           = $this->data['zip'];
        $this->company->country       = $this->data['country'];
        $this->company->facebook_url  = $this->data['facebook_url'];
        $this->company->twitter_url   = $this->data['twitter_url'];
        $this->company->instagram_url = $this->data['instagram_url'];
        $this->company->added_by      = Auth::guard('sanctum')->user()->id;

        $this->company->save();
        $this->saveImages( $this->company );

        return true;
    }

    private function saveImages( $company )
    {
        $uploadCompanyImages = new UploadCompanyImages( $company );

        if ( isset( $this->data['logo'] ) ) {
            $uploadCompanyImages->saveLogoImage( $this->data['logo'] );
        }

        if ( isset( $this->data['header'] ) ) {
            $uploadCompanyImages->saveHeaderImage( $this->data['header'] );
        }
    }
}
