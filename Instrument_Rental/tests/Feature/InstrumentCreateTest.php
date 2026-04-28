<?php

namespace Tests\Feature;

use App\Models\InstrumentBrand;
use App\Models\InstrumentCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Tests for instrument creation via POST /api/instruments.
 *
 * Only admin users may create instruments. The endpoint validates the input
 * and writes monthly_price, deposit, and image to the database
 * (this was the field set affected by the historical mass assignment bug).
 */
class InstrumentCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * An admin can create a new instrument with valid data.
     * Verifies that monthly_price and deposit are persisted correctly
     * (regression test for the mass assignment bug).
     */
    public function test_admin_can_create_instrument(): void
    {
        // Arrange — admin user, one category, and one brand
        $admin = User::factory()->admin()->create();

        $category = InstrumentCategory::create([
            'category_name' => 'Akusztikus gitár',
        ]);
        $brand = InstrumentBrand::create([
            'brand_name' => 'Yamaha',
        ]);

        $payload = [
            'category_id'   => $category->id,
            'brand_id'      => $brand->id,
            'condition'     => 'Új',
            'title'         => 'Yamaha F310',
            'description'   => 'Belépő szintű akusztikus gitár.',
            'monthly_price' => 6000,
            'deposit'       => 15000,
        ];

        $response = $this->actingAs($admin)->postJson('/api/instruments', $payload);

        $response->assertStatus(201);
        $response->assertJsonPath('title', 'Yamaha F310');
        $response->assertJsonPath('monthly_price', 6000);
        $response->assertJsonPath('deposit', 15000);

        $this->assertDatabaseHas('instruments', [
            'title'         => 'Yamaha F310',
            'monthly_price' => 6000,
            'deposit'       => 15000,
        ]);
    }

    /**
     * A regular (non-admin) user cannot create instruments.
     * The is_admin middleware must block them with 403 Forbidden.
     */
    public function test_regular_user_cannot_create_instrument(): void
    {
        $user = User::factory()->create(['is_admin' => 0]);

        $category = InstrumentCategory::create(['category_name' => 'Akusztikus gitár']);
        $brand    = InstrumentBrand::create(['brand_name' => 'Yamaha']);

        $payload = [
            'category_id'   => $category->id,
            'brand_id'      => $brand->id,
            'condition'     => 'Új',
            'title'         => 'Próba hangszer',
            'description'   => 'Próba leírás.',
            'monthly_price' => 5000,
            'deposit'       => 10000,
        ];

        $response = $this->actingAs($user)->postJson('/api/instruments', $payload);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('instruments', [
            'title' => 'Próba hangszer',
        ]);
    }
}
