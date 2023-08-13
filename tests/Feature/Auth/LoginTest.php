<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected $user = [];

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
    }

    public function test_user_can_login(): void
    {
        $user = $this->createUser([
            'email' => 'test@mail.ru',
            'password' => 12345678
        ]);

        $response = $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => 12345678,
        ])
            ->assertOk();

        $this->assertArrayHasKey('email', $response->json());
    }

    public function test_if_user_email_is_not_available_then_it_return_error()
    {
        $response = $this->postJson(route('login'), [
            'email' => 'wrong_email@mail.com',
            'password' => $this->user->password,
        ])->assertUnauthorized();

    }

    public function test_it_raise_error_if_password_not_confirmed()
    {
        $response = $this->postJson(route('login'), [
            'email' => $this->user->email,
            'password' => 'wrong password',
        ])->assertUnauthorized();
    }

}
