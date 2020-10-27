<?php

namespace Tests\Feature\API\Cafe;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CreateCafeTest extends TestCase
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

    public function testCreateCafeForCompany()
    {
        $primary_image = UploadedFile::fake()->image('primary_image.jpg');

        $this->actingAs( $this->user )
            ->json( 'POST', '/api/v1/companies/' . $this->company->slug . '/cafes', [
                'location_name'  => 'Stevens Point',
                'address'        => '1410 3rd St.',
                'city'           => 'Stevens Point',
                'state'          => 'WI',
                'country'        => 'US',
                'zip'            => '54481',
                'tea'            => 1,
                'matcha'         => 0,
                'description'    => 'Some text here',
                'primary_image'  => $primary_image
            ])
            ->assertStatus( 201 );

        $this->assertDatabaseHas( 'cafes', [
            'company_id'    => $this->company->id,
            'location_name' => 'Stevens Point'
        ]);
    }
}
