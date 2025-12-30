<?php

use App\Livewire\Settings\CompanyInfo;
use App\Livewire\ContactPage;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('contacts', 'contacts')
    ->middleware(['auth', 'verified'])
    ->name('contacts.all');

Route::get('/contact/{contact}', ContactPage::class)
    ->middleware(['auth', 'verified'])
    ->name('contact.show');

Route::view('inventory', 'inventory')
    ->middleware(['auth', 'verified'])
    ->name('inventory');

Route::view('invoices', 'invoices')
    ->middleware(['auth', 'verified'])
    ->name('invoices');

Route::view('orders', 'orders')
    ->middleware(['auth', 'verified'])
    ->name('orders');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');
    Route::get('settings/company-info', CompanyInfo::class)->name('company-info.edit');
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

// API routes for products
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
