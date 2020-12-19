<?php


namespace App\Services\Cafe;

use App\Services\Cafe\UploadCafeImages;

class UpdateCafe
{
    private $data;
    private $company;
    private $cafe;

    public function __construct( $company, $cafe, $cafeData )
    {
        $this->cafe = $cafe;
        $this->company = $company;
        $this->data = $cafeData;
    }

    public function save()
    {
        return $this->persistUpdates();
    }

    private function persistUpdates()
    {
        $this->cafe->company_id       = $this->company->id;
        $this->cafe->location_name    = $this->data['location_name'];
        $this->cafe->description      = $this->data['description'];
        $this->cafe->address          = $this->data['address'];
        $this->cafe->city             = $this->data['city'];
        $this->cafe->state            = $this->data['state'];
        $this->cafe->zip              = $this->data['zip'];
        $this->cafe->country          = $this->data['country'];
        $this->cafe->tea              = $this->data['tea'];
        $this->cafe->matcha           = $this->data['matcha'];

        $this->cafe->save();
        $this->saveImages();
        $this->saveBrewMethods();

        return true;
    }

    private function saveImages( )
    {
        $uploadCafeImages = new UploadCafeImages( $this->cafe );

        if ( isset( $this->data['primary_image'] ) ) {
            $uploadCafeImages->savePrimaryImage( $this->data['primary_image'] );
        }
    }

    /**
     * Saves brew methods to cafe
     */
    private function saveBrewMethods() {
        if ( isset( $this->data['brew_methods'] ) ) {
            $brewMethodsArr = explode(',', $this->data['brew_methods']);

            $this->cafe->brewMethods()->sync( $brewMethodsArr );
        }
    }
}
