<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

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
        $response = $this->post("/users/$valid_user_id/edit-details", $details);
        $response->assertStatus(200);
        //TODO assert
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
        $response = $this->post("/users/$invalid_user_id/edit-details", $details);
        $response->assertStatus(200);
        //TODO assert

    }


}
