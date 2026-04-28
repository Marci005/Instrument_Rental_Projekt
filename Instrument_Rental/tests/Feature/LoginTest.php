<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Tests for the user login flow.
 *
 * The /api/login endpoint validates credentials and starts a session.
 * Like /api/register, the happy path involves session()->regenerate(),
 * so we test the credential check directly via Auth::attempt(),
 * and use HTTP for the failure paths where the controller returns early.
 */
class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifies that the credential check itself works:
     * Auth::attempt() succeeds with the correct password and fails with
     * the wrong password. This is the underlying mechanism the
     * AuthController uses to authenticate users.
     */
    public function test_credentials_check_works_for_valid_user(): void
    {
        User::factory()->create([
            'email'    => 'pista@example.com',
            'password' => Hash::make('helyesjelszo'),
        ]);

        $this->assertTrue(Auth::attempt([
            'email'    => 'pista@example.com',
            'password' => 'helyesjelszo',
        ]));

        $this->assertFalse(Auth::attempt([
            'email'    => 'pista@example.com',
            'password' => 'rosszjelszo',
        ]));
    }

    /**
     * Login fails with a 422 validation error when the password is incorrect.
     */
    public function test_user_cannot_login_with_wrong_password(): void
    {
        User::factory()->create([
            'email'    => 'pista@example.com',
            'password' => Hash::make('helyesjelszo'),
        ]);

        $response = $this->postJson('/api/login', [
            'email'    => 'pista@example.com',
            'password' => 'rosszjelszo',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    /**
     * Login fails when the email does not exist in the database.
     */
    public function test_user_cannot_login_with_unknown_email(): void
    {
        $response = $this->postJson('/api/login', [
            'email'    => 'nemletezo@example.com',
            'password' => 'akarmijelszo',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }
}
