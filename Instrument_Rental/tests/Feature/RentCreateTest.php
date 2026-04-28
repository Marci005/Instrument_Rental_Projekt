<?php

namespace Tests\Feature;

use App\Models\Instrument;
use App\Models\InstrumentBrand;
use App\Models\InstrumentCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Tests for rental creation via POST /api/rents.
 *
 * Authenticated users may create rents for themselves.
 * Unauthenticated guests must be rejected with 401.
 */
class RentCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper: create a category, brand, and a single instrument
     * for use across multiple tests.
     */
    private function createInstrument(): Instrument
    {
        $category = InstrumentCategory::create(['category_name' => 'Akusztikus gitár']);
        $brand    = InstrumentBrand::create(['brand_name' => 'Yamaha']);

        return Instrument::create([
            'category_id'   => $category->id,
            'brand_id'      => $brand->id,
            'condition'     => 'Új',
            'title'         => 'Yamaha F310',
            'description'   => 'Belépő szintű akusztikus gitár.',
            'monthly_price' => 6000,
            'deposit'       => 15000,
        ]);
    }

    /**
     * An authenticated user can create a rent for an existing instrument.
     */
    public function test_authenticated_user_can_create_rent(): void
    {
        $user = User::factory()->create();
        $instrument = $this->createInstrument();

        $payload = [
            'instrument_id' => $instrument->id,
            'start_date'    => now()->addDay()->toDateString(),
            'end_date'      => now()->addMonth()->toDateString(),
            'rent_price'    => 6000,
        ];

        $response = $this->actingAs($user)->postJson('/api/rents', $payload);

        $response->assertStatus(201);
        $this->assertDatabaseHas('rents', [
            'user_id'       => $user->id,
            'instrument_id' => $instrument->id,
            'rent_price'    => 6000,
        ]);
    }

    /**
     * A guest cannot create a rent. The auth:sanctum middleware
     * returns 401 Unauthorized.
     */
    public function test_guest_cannot_create_rent(): void
    {
        $instrument = $this->createInstrument();

        $payload = [
            'instrument_id' => $instrument->id,
            'start_date'    => now()->addDay()->toDateString(),
            'end_date'      => now()->addMonth()->toDateString(),
            'rent_price'    => 6000,
        ];

        $response = $this->postJson('/api/rents', $payload);

        $response->assertStatus(401);
        $this->assertDatabaseCount('rents', 0);
    }
}
