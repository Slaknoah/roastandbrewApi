<?php


namespace Tests\API\Company;

use App\Models\Cafe;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoadCafesTest extends TestCase
{
    use RefreshDatabase;

    private $company;
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->company = Company::factory()->create([
            'added_by'   => $this->user->id
        ]);
    }

    public function testNoCafesLoaded()
    {
        $response = $this->getJson('/api/v1/companies/' . $this->company->slug . '/cafes' );

        $response
            ->assertStatus(200)
            ->assertJsonCount(0);
    }

    public function testFiveCafesLoaded()
    {
        Cafe::factory()->count(5)->create([
            'company_id'  => $this->company->id
        ]);

        $response = $this->getJson('/api/v1/companies/' . $this->company->slug . '/cafes' );

        $response
            ->assertStatus(200)
            ->assertJsonCount(5);
    }
}
