<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::find( 1 );
        $owner = User::find( 2 );

        $companies = Company::factory()
                    ->times( 20 )
                    ->create([
                        'added_by' => $admin->id
                    ]);

        foreach ( $companies as $key => $company ) {
            $company->owners()->sync([ $owner->id ]);

            if ($key == random_int($key, $key + 1)) {
                $company->likes()->sync( [ $owner->id, $admin->id ] );
            }
        }
    }
}
