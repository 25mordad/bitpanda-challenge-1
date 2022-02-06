<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\Country;

class UserTest extends TestCase
{
    public function test_get_active_austrians()
    {
        $response = $this->getJson('/users/active-austrians');

        $response->assertJson(fn (AssertableJson $json) => $json->has(2));
    }
    
    public function test_edit_details_for_valid_user()
    {
        $valid_user_id = 7;
        $details = [
            'first_name' => 'Diego',
            'last_name' => 'Lopez',
            'phone_number' => '003434343434',
            'country_iso3' => 'ESP'
        ];
        $response = $this->put("/users/$valid_user_id/edit-details", $details);
        $response->assertStatus(302);
        $assertAttributes = [
            'user_id' => $valid_user_id,
            'citizenship_country_id' => Country::where('iso3', $details['country_iso3'])->first()->id,
            'first_name' => $details['first_name'],
            'last_name' => $details['last_name'],
            'phone_number' => $details['phone_number']
        ];
        $this->assertDatabaseHas('user_details', $assertAttributes);
    }

    public function test_edit_details_for_invalid_user()
    {
        $invalid_user_id = 2;
        $details = [
            'first_name' => 'Diego',
            'last_name' => 'Lopez',
            'phone_number' => '003434343434',
            'country_iso3' => 'ESP'
        ];
        $response = $this->put("/users/$invalid_user_id/edit-details", $details);
        $response->assertStatus(403);
    }

    public function test_delete_a_valid_user()
    {
        // This test only works for first time!
        //TODO Create a user by factory then delete it
        $valid_user_id = 3;
        $response = $this->delete("/users/$valid_user_id");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('users', ['id' => $valid_user_id]);
    }

    public function test_delete_an_invalid_user()
    {
        $invalid_user_id = 7;
        $response = $this->delete("/users/$invalid_user_id");
        $response->assertStatus(403);
    }

}
