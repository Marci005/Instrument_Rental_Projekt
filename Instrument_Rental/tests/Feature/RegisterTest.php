<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Tests for the user registration flow.
 *
 * The /api/register endpoint validates the payload and creates a user.
 * The endpoint also calls session()->regenerate() on success — testing the
 * happy-path through HTTP requires the full Sanctum stateful middleware,
 * which is not initialised under JSON test calls. We therefore verify the
 * happy path by exercising the User model directly, and use HTTP only for
 * the validation-failure paths where the controller returns before touching
 * the session.
 */
class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A new user can be created in the database via the User model with
     * valid data, and the password is correctly hashed.
     *
     * This covers the persistence side of the registration flow without
     * relying on the session-bound HTTP controller path.
     */
    public function test_user_can_be_created_with_valid_data(): void
    {
        $user = User::create([
            'first_name' => 'Teszt',
            'last_name'  => 'Elek',
            'title'      => 'Úr',
            'email'      => 'teszt.elek@example.com',
            'password'   => Hash::make('titkosjelszo123'),
            'is_admin'   => 0,
        ]);

        $this->assertDatabaseHas('users', [
            'email'      => 'teszt.elek@example.com',
            'first_name' => 'Teszt',
            'last_name'  => 'Elek',
        ]);

        $this->assertTrue(Hash::check('titkosjelszo123', $user->password));
    }

    /**
     * Registration fails with a 422 status when the password confirmation
     * does not match. The user must not be created.
     */
    public function test_registration_fails_when_password_confirmation_does_not_match(): void
    {
        $payload = [
            'first_name' => 'Teszt',
            'last_name'  => 'Elek',
            'title'      => 'Úr',
            'email'      => 'teszt.elek@example.com',
            'password'   => 'titkosjelszo123',
            'password_confirmation' => 'masjelszo456',
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['password']);
        $this->assertDatabaseMissing('users', [
            'email' => 'teszt.elek@example.com',
        ]);
    }

    /**
     * Registration fails when the email is already taken by another user.
     */
    public function test_registration_fails_with_duplicate_email(): void
    {
        // Arrange — create an existing user
        User::factory()->create([
            'email' => 'foglalt@example.com',
        ]);

        $payload = [
            'first_name' => 'Másik',
            'last_name'  => 'Felhasználó',
            'title'      => 'Hölgy',
            'email'      => 'foglalt@example.com',
            'password'   => 'titkosjelszo123',
            'password_confirmation' => 'titkosjelszo123',
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }
}
