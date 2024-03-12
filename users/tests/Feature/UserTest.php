<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_user()
    {
        $random = uniqid();
        $this->post('/api/user', [
            'firstName' => 'Daniel',
            'lastName' => 'Ozeh',
            'email' => 'danielozeh_' . $random . '@gmail.com',
        ])->assertStatus(201);
    }
}
