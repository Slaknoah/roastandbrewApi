<?php


namespace App\Services\Company;

use Illuminate\Support\Facades\Auth;

class LikeCompany
{
    private $company;

    public function __construct( $company )
    {
        $this->company = $company;
    }

    public function toggle()
    {
        if ( $this->company->likes->contains( Auth::guard('sanctum')->user()->id ) ) {
            $this->company->likes()->detach( Auth::guard('sanctum')->user()->id );

            return [
                'status'    => false,
                'likes'     => $this->company->likes->count() - 1
            ];
        } else {
            $this->company->likes()->attach( Auth::guard('sanctum')->user()->id );

            return [
                'status'    => true,
                'likes'     => $this->company->likes->count() + 1
            ];
        }
    }
}
