<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Tests for the admin-only route protection.
 *
 * The /api/users endpoint is protected by:
 *   - auth:sanctum (must be authenticated)
 *   - is_admin     (must have is_admin = 1)
 *
 * Verifies all three possible authorisation outcomes:
 *   - 401 Unauthorized for unauthenticated guests
 *   - 403 Forbidden for authenticated non-admin users
 *   - 200 OK for authenticated admins
 */
class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A guest (no login) cannot access the admin user list endpoint.
     */
    public function test_guest_gets_401_on_users_endpoint(): void
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(401);
    }

    /**
     * A regular (non-admin) user cannot access the admin user list endpoint.
     */
    public function test_regular_user_gets_403_on_users_endpoint(): void
    {
        $user = User::factory()->create(['is_admin' => 0]);

        $response = $this->actingAs($user)->getJson('/api/users');

        $response->assertStatus(403);
    }

    /**
     * An admin user can access the user list endpoint.
     */
    public function test_admin_user_can_access_users_endpoint(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->getJson('/api/users');

        $response->assertStatus(200);
    }
}
