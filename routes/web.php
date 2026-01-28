<?php

use App\Http\Controllers\Api\V1\ContactController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\ItemController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Livewire\ContactPage;
use App\Livewire\Dashboard;
use App\Livewire\Inventory;
use App\Livewire\Invoices;
use App\Livewire\Orders;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\CompanyInfo;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\ProductCategories;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/contact/{contact}', ContactPage::class)
        ->middleware('can:view,contact')
        ->name('contact.show');

    Route::get('inventory', Inventory::class)
        ->name('inventory');

    Route::get('/invoices', Invoices::class)
        ->name('invoices');

    Route::get('/orders', Orders::class)
        ->name('orders');

    Route::get('/vector', App\Livewire\Vector::class)
        ->name('vector');
    Route::get('dashboard', Dashboard::class)
        ->name('dashboard');

    Route::view('contacts', 'contacts')
        ->name('contacts.all');
});
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');
    Route::get('settings/company-info', CompanyInfo::class)->name('company-info.edit');
    Route::get('settings/product-categories', ProductCategories::class)->name('product-categories.edit');
    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// Legacy API route for fetching a single product
Route::middleware(['auth', 'verified'])->prefix('api')->group(function () {
    Route::get('products/{product}', function (\App\Models\Product $product) {
        return response()->json([
            'id' => $product->id,
            'product_id' => $product->product_id,
            'name' => $product->name,
            'description' => $product->description,
            'purchase_price' => (float) $product->purchase_price,
            'delivery_charges' => (float) $product->delivery_charges,
            'retail_price' => (float) $product->retail_price,
            'margin' => round((($product->retail_price - $product->purchase_price) / $product->retail_price) * 100, 2),
            'created_at_formatted' => $product->created_at->format('M d, Y'),
            'updated_at_formatted' => $product->updated_at->format('M d, Y'),
        ]);
    });
});

// Versioned JSON API (v1)
Route::middleware(['auth', 'verified'])
    ->prefix('api/v1')
    ->as('api.v1.')
    ->group(function () {
        Route::apiResource('items', ItemController::class)
            ->parameters(['items' => 'product']);

        Route::apiResource('contacts', ContactController::class);

        Route::apiResource('orders', OrderController::class);

        Route::apiResource('invoices', InvoiceController::class)
            ->only(['index', 'show', 'update', 'destroy']);
    });
