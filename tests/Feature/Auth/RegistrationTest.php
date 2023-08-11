<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use  RefreshDatabase;

    public function test_user_can_register(): void
    {
        $this->postJson(route('register', [
            'name' => 'starscy',
            'email' => 'test@mail.com',
            'password' => 12345678,
            'password_confirmation' => 12345678,
        ]));

        $this->assertDatabaseHas('users', [
            'name' => 'starscy'
        ]);
    }
}
