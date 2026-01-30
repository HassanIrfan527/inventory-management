<?php

use App\Http\Controllers\Api\V1\ContactController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\ItemController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Livewire\Contacts\Show as ContactShow;
use App\Livewire\Dashboard;
use App\Livewire\Invoices\Index as InvoicesIndex;
use App\Livewire\Orders\Index as OrdersIndex;
use App\Livewire\Settings\CompanyInfo;
use App\Livewire\Settings\ProductCategories;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::livewire('/', 'welcome')->name('home');
Route::get('/blog', \App\Livewire\Blog\Index::class)->name('blog.index');

Route::livewire('/contact-us', 'pages::contact-us')->name('contact.us');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/contact/{contact}', ContactShow::class)
        ->middleware('can:view,contact')
        ->name('contact.show');

    Route::livewire('inventory', 'products.inventory')
        ->name('inventory');

    Route::get('/invoices', InvoicesIndex::class)
        ->name('invoices');

    Route::get('/orders', OrdersIndex::class)
        ->name('orders');

    Route::get('/order/{order:order_number}', \App\Livewire\Orders\Show::class)
        ->name('orders.show');

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
    Route::livewire('settings/password', 'settings.password')->name('user-password.edit');
    Route::livewire('settings/appearance', 'settings.appearance')->name('appearance.edit');
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
