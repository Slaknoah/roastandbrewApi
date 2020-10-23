<?php


namespace App\Services\Cafe;

use Illuminate\Support\Facades\Storage;

class UploadCafeImages
{
    private $cafe;

    public function __construct( $cafe )
    {
        $this->cafe = $cafe;
    }

    public function savePrimaryImage( $primary_image )
    {
        $url = $this->saveFile( $primary_image );

        $this->cafe->primary_image_url = $url;
        $this->cafe->save();
    }

    public function saveFile( $file ) {
        $path = Storage::put( '/public/cafes/' . $this->cafe->slug, $file );

        $fileURL = env( 'APP_URL' ) . '/storage/' . str_replace( 'public/', '', $path );

        return $fileURL;
    }
}
