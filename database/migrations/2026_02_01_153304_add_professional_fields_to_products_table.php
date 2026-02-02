<?php

use App\Enums\Products\Status;
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
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku')->unique()->nullable()->after('product_id');
            $table->integer('stock_quantity')->nullable()->after('retail_price'); // NULL = Infinite
            $table->string('status')->default(Status::ACTIVE->value)->after('stock_quantity');
            $table->text('internal_notes')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['sku', 'stock_quantity', 'status', 'internal_notes']);
        });
    }
};
