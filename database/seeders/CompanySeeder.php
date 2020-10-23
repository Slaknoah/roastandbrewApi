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

        Company::factory()
                    ->times( 20 )
                    ->create([
                        'added_by' => $user->id
                    ]);
    }
}
