<?php


namespace Tests\API\Company;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class CreateCompanyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateCompany()
    {
        $user = User::factory()->create();

        $companyToAdd = [
            'name'          => 'Ruby Coffee',
            'roaster'       => 1,
            'subscription'  => 1,
            'description'   => 'Colourful coffee',
            'website' => 'https://rubycoffeeroasters.com/',
            'address' => '9515 Water St',
            'city' => 'Nelsonville',
            'state' => 'WI',
            'zip' => '54407',
            'facebook_url' => 'https://www.facebook.com/rubyroasters',
            'twitter_url' => 'https://twitter.com/rubyroasters',
            'instagram_url' => 'http://instagram.com/rubyroasters'
        ];

        $this->actingAs( $user )
            ->json( 'POST', '/api/v1/companies', $companyToAdd)
            ->assertStatus( 201 );

        /**
         * Ensures database has proper values
         */
        $this->assertDatabaseHas('companies', [
           'name'       => 'Ruby Coffee',
           'added_by'   => $user->id
        ]);

    }
}
