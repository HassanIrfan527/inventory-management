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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->onDelete('cascade');
            $table->foreignId('contact_id')->constrained()->onDelete('cascade'); // The "Who"
            $table->string('description'); // e.g., "Order #101 was placed"

            // These two columns allow the log to link to an Order, Invoice, or Product
            $table->nullableMorphs('subject');

            $table->json('properties')->nullable(); // Optional: Store old vs new values
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
