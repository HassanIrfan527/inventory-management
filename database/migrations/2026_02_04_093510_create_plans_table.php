<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');                              // Pro, Business
            $table->string('slug')->unique();                    // pro, business
            $table->text('description')->nullable();
            $table->string('stripe_product_id')->unique();       // prod_ABC123
            $table->string('stripe_monthly_price_id')->unique(); // price_ABC123
            $table->string('stripe_yearly_price_id')->nullable()->unique();  // price_DEF456
            $table->integer('monthly_price');                    // 1200 (cents)
            $table->integer('yearly_price')->nullable();                     // 12000 (cents)
            $table->json('features');
            $table->tinyInteger('is_active')->default(1)->comment('1 = Active, 0 = Inactive');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
