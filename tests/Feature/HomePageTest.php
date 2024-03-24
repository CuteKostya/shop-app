<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $a = 1;

        $this->assertEquals(1, $a);

        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertOk();

        $product = Product::factory()->create([
            'id' => 1000,
            'name' => 'ddd',
        ]);
        $response = $this->get('/products/1000');
    }
}
