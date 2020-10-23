<?php


namespace App\Services\Company;

use Illuminate\Support\Facades\Storage;

class UploadCompanyImages
{
    private $company;

    public function __construct( $company )
    {
        $this->company = $company;
    }

    public function saveLogoImage( $logo )
    {
        $url = $this->saveFile( $logo );

        $this->company->logo_url = $url;
        $this->company->save();
    }

    public function saveHeaderImage( $header )
    {
        $url = $this->saveFile( $header );

        $this->company->header_image_url = $url;
        $this->company->save();
    }

    private function saveFile( $file )
    {
        $path = Storage::put( '/public/companies/' . $this->company->slug, $file );

        $fileURL = env( 'APP_URL' ) . '/storage/' . str_replace( 'public/', '', $path );

        return $fileURL;
    }
}
