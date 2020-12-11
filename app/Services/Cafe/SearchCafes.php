<?php


namespace App\Services\Cafe;


use App\Models\Cafe;

class SearchCafes
{
    private $take;
    private $orderBy;
    private $orderDirection;
    private $search;
    private $query;
    private $company;


    public function __construct( $parameters )
    {
        $this->setLocalParameters( $parameters );
        $this->query = Cafe::query();
    }

    public function search()
    {
        $this->applySearch();
        $this->applyCompanyFilter();
        $this->applyOrder();

        // Eager load relationships
        return $this->query->paginate( $this->take );
    }

    private function applyCompanyFilter()
    {
        if( $this->company != '' ){
            $this->query->where( 'company_id', '=', $this->company );
        }
    }

    private function applySearch()
    {
        if( $this->search != '' ){
            $search = urldecode( $this->search );

            $this->query->where(function( $query ) use ($search) {
                $query->where('name', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('city', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('address', 'LIKE', '%'.$this->search.'%')
                    ->orWhereHas('company', function ( $query ) use ( $search ) {
                        $query->where( 'name', 'LIKE', '%'.$search.'%' );
                    } );
            });
        }
    }

    private function applyOrder()
    {
        $this->query->orderBy( $this->orderBy, $this->orderDirection );
    }

    private function setLocalParameters( $parameters )
    {
        $this->company          = isset( $parameters['company'] ) ? $parameters['company'] : '';
        $this->take             = isset( $parameters['take'] ) ? $parameters['take'] : config( 'resources.items_per_page');
        $this->orderBy          = isset( $parameters['order_by'] ) ? $parameters['order_by'] : 'location_name';
        $this->orderDirection   = isset( $parameters['order_direction'] ) ? $parameters['order_direction'] : 'ASC';
        $this->search           = isset( $parameters['search'] ) ? $parameters['search'] : '';
    }
}
