<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginRedirectTest extends TestCase
{
    public function test_login_returns_to_an_intended_create_form(): void
    {
        $this->get(route('monsterhunters.create'))
            ->assertRedirect(route('login'));

        Auth::shouldReceive('attempt')
            ->once()
            ->with(['email' => 'hunter@example.com', 'password' => 'password'])
            ->andReturnTrue();

        $response = $this->post(route('login.store'), [
            'email' => 'hunter@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('monsterhunters.create'));
    }

    public function test_login_without_an_intended_url_redirects_to_create_form(): void
    {
        Auth::shouldReceive('attempt')
            ->once()
            ->with(['email' => 'hunter@example.com', 'password' => 'password'])
            ->andReturnTrue();

        $response = $this->post(route('login.store'), [
            'email' => 'hunter@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('monsterhunters.create'));
    }
}
