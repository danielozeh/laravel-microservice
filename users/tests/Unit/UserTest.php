<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Storage;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_name_equals()
    {
        $random = uniqid();
        $first_name = 'Daniel';
        $last_name = 'Ozeh';
        $email = 'danielozeh_' . $random . '@gmail.com';

        $newUser = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
        ];

        $user  = $newUser;

        $this->assertEquals("Daniel", $user['first_name']);
    }
}
