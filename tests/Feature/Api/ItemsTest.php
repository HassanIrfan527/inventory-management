<?php

use App\Models\Product;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;

it('requires authentication for items index', function () {
    getJson('/api/v1/items')->assertUnauthorized();
});

it('lists items for authenticated users', function () {
    $user = User::factory()->create();

    actingAs($user);

    Product::factory()->count(2)->create();

    getJson('/api/v1/items')
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'product_id',
                    'name',
                    'description',
                    'purchase_price',
                    'retail_price',
                    'delivery_charges',
                ],
            ],
        ]);
});

it('validates store item request', function () {
    $user = User::factory()->create();

    actingAs($user);

    postJson('/api/v1/items', [])->assertStatus(422)->assertJsonValidationErrors([
        'name',
        'description',
        'cost_price',
        'retail_price',
        'delivery_charges',
    ]);
});

it('creates an item via the api', function () {
    $user = User::factory()->create();

    actingAs($user);

    $payload = [
        'name' => 'Test Product',
        'description' => 'Test description',
        'cost_price' => 100,
        'retail_price' => 150,
        'delivery_charges' => 10,
    ];

    postJson('/api/v1/items', $payload)
        ->assertCreated()
        ->assertJsonPath('data.name', 'Test Product')
        ->assertJsonPath('data.retail_price', 150.0);

    expect(Product::where('name', 'Test Product')->exists())->toBeTrue();
});
