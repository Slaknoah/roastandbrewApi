<?php


namespace App\Services\Company;

use App\Models\Company;
use App\Models\User;
use App\Services\Company\UploadCompanyImages;
use Illuminate\Support\Facades\Auth;

class CreateCompany
{
    private $data;

    public function __construct( $newCompanyData )
    {
        $this->data = $newCompanyData;
    }

    public function save()
    {
        return $this->persistCompany();
    }

    private function persistCompany()
    {
        $company = new Company();

        $company->name          = $this->data['name'];
        $company->roaster       = $this->data['roaster'];
        $company->subscription  = $this->data['subscription'];
        $company->description   = $this->data['description'];
        $company->website       = $this->data['website'];
        $company->address       = $this->data['address'];
        $company->city          = $this->data['city'];
        $company->state         = $this->data['state'];
        $company->zip           = $this->data['zip'];
        $company->country       = $this->data['country'];
        $company->facebook_url  = $this->data['facebook_url'];
        $company->twitter_url   = $this->data['twitter_url'];
        $company->instagram_url = $this->data['instagram_url'];
        $company->header_image_url  = '';
        $company->logo_url          = '';
        $company->added_by      = Auth::guard('sanctum')->user()->id;

        $company->save();
        $this->saveImages( $company );
        $company->owners()->sync([ Auth::guard('sanctum')->user()->id ]);
        return $company;
    }

    private function saveImages( $company ) {
        $uploadCompanyImages = new UploadCompanyImages( $company );

        if ( isset( $this->data['logo'] ) ) {
            $uploadCompanyImages->saveLogoImage( $this->data['logo'] );
        }

        if ( isset( $this->data['header'] ) ) {
            $uploadCompanyImages->saveHeaderImage( $this->data['header'] );
        }
    }
}
