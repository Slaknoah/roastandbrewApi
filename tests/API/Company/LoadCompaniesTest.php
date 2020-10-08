<?php


namespace Tests\API\Company;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoadCompaniesTest extends TestCase
{
    use RefreshDatabase;

    public function testNoCompaniesLoaded()
    {
        $response = $this->getJson('/api/v1/companies');

        $response
            ->assertStatus(200)
            ->assertJsonCount(0);
    }

    public function testFiveCompaniesLoaded()
    {
        $user = User::factory()->create();
        Company::factory()->count(5)->create([
            'added_by'  => $user->id
        ]);

        $response = $this->getJson('/api/v1/companies');

        $response
            ->assertStatus(200)
            ->assertJsonCount(5);
    }
}
