<?php

namespace Tests\Feature;

use App\Models\Instrument;
use App\Models\InstrumentBrand;
use App\Models\InstrumentCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Tests for the public instruments listing endpoint.
 *
 * The /api/instruments endpoint must be accessible without authentication.
 */
class InstrumentListTest extends TestCase
{
    /**
     * RefreshDatabase trait re-creates the SQLite in-memory database before each test,
     * giving every test a clean slate.
     */
    use RefreshDatabase;

    /**
     * Verifies that the public /api/instruments endpoint is accessible
     * without authentication and returns a 200 OK response with JSON data.
     */
    public function test_anyone_can_list_instruments(): void
    {
        // Arrange — create one category, one brand, and one instrument
        $category = InstrumentCategory::create([
            'category_name' => 'Akusztikus gitár',
        ]);

        $brand = InstrumentBrand::create([
            'brand_name' => 'Yamaha',
        ]);

        Instrument::create([
            'category_id'   => $category->id,
            'brand_id'      => $brand->id,
            'condition'     => 'Új',
            'title'         => 'Yamaha F310',
            'description'   => 'Belépő szintű akusztikus gitár.',
            'monthly_price' => 6000,
            'deposit'       => 15000,
        ]);

        // Act — call the public endpoint without logging in
        $response = $this->getJson('/api/instruments');

        // Assert — successful response with the seeded instrument
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['title' => 'Yamaha F310']);
    }
}
