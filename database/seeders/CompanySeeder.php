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
        $user = User::find( 1 );

        $companies = Company::factory()
                    ->times( 20 )
                    ->create([
                        'added_by' => $user->id
                    ]);

        foreach ( $companies as $key => $company ) {
            $company->owners()->sync([ $user->id ]);

            if ($key == random_int($key, $key + 1)) {
                $company->likes()->sync( [ $user->id ] );
            }
        }
    }
}
