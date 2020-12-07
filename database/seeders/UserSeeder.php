<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
                ->create([
                    'email'     => 'admin@email.com',
                    'name'      => 'admin',
                    'password'  => bcrypt('secret'),
                    'permission'=> 'admin'
                ]);

        User::factory()->create([
            'email'     => 'owner@email.com',
            'name'      => 'owner',
            'password'  => bcrypt('secret'),
            'permission'=> 'owner'
        ]);

        User::factory()->create([
            'email'     => 'user@email.com',
            'name'      => 'user',
            'password'  => bcrypt('secret'),
            'permission'=> 'user'
        ]);
    }
}
