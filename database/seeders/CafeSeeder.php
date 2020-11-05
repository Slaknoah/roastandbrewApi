<?php

namespace Database\Seeders;

use App\Models\BrewMethod;
use App\Models\Cafe;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CafeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $companies = Company::where( 'id', '<', '6' )->get();

        $brew_methods = BrewMethod::all( 'id' );

        $brew_methods = array_map( function( $arr ) {
            return $arr['id'];
        }, $brew_methods->toArray() );

        foreach ( $companies as $company ) {
            $cafes = Cafe::factory()->times( 7)->create([
                'company_id'    => $company->id
            ]);

            foreach ( $cafes as $cafe ) {
                $brew_methods_to_add = array_splice( $brew_methods, 0, random_int( 3, 7 )  );
                $cafe->brewMethods()->sync( $brew_methods_to_add );
            }
        }
    }
}
