<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_get_active_austrians()
    {
        $response = $this->getJson('/users/active-austrians');

        $response->assertStatus(200);
    }

}
