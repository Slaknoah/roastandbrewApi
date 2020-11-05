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
        $user = Auth::guard('sanctum')->user()->id;
        if ( $this->company->likes->contains( $user ) ) {
            $this->company->likes()->detach( $user );

            return [
                'status'    => false,
                'likes'     => $this->company->likes->count() - 1
            ];
        } else {
            $this->company->likes()->attach( $user );

            return [
                'status'    => true,
                'likes'     => $this->company->likes->count() + 1
            ];
        }
    }
}
