<?php


namespace App\Services\Cafe;


use App\Models\Cafe;

class CreateCafe
{
    private $data;
    private $company;

    public function __construct( $newCafeData, $company )
    {
        $this->data     = $newCafeData;
        $this->company  = $company;
    }

    public function save()
    {
        $this->persistCafe();
    }

    public function persistCafe()
    {
        $cafe = new Cafe();

        $cafe->company_id       = $this->company->id;
        $cafe->location_name    = $this->data['location_name'];
        $cafe->description      = $this->data['description'];
        $cafe->primary_image_url= '';
        $cafe->address          = $this->data['address'];
        $cafe->city             = $this->data['city'];
        $cafe->state            = $this->data['state'];
        $cafe->province         = $this->data['province'];
        $cafe->territory        = $this->data['territory'];
        $cafe->zip              = $this->data['zip'];
        $cafe->country          = $this->data['country'];

        $cafe->save();
        $this->saveImages( $cafe );

        return $cafe;
    }

    private function saveImages( $cafe )
    {
        $uploadCafeImages = new UploadCafeImages( $cafe );

        if ( isset( $this->data['primary_image'] ) ) {
            $uploadCafeImages->savePrimaryImage( $this->data['primary_image'] );
        }
    }
}
