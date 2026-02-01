<?php

use App\Enums\Order\OrderSource;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Payment\PaymentStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('subtotal_amount', 12, 2)->default(0)->after('contact_id');
            $table->decimal('tax_amount', 12, 2)->default(0)->after('subtotal_amount');
            $table->decimal('discount_amount', 12, 2)->default(0)->after('tax_amount');
            $table->decimal('total_amount', 12, 2)->change();

            $table->string('payment_status')->default(PaymentStatus::UNPAID->value)->after('status');
            $table->string('payment_method')->nullable()->after('payment_status');

            $table->string('shipping_method')->nullable()->after('payment_method');
            $table->string('tracking_number')->nullable()->after('shipping_method');
            $table->timestamp('shipped_at')->nullable()->after('tracking_number');
            $table->timestamp('delivered_at')->nullable()->after('shipped_at');

            $table->text('customer_notes')->nullable()->after('delivered_at');
            $table->text('internal_notes')->nullable()->after('customer_notes');
            $table->string('source')->default(OrderSource::MANUAL->value)->after('internal_notes');

            $table->softDeletes();
        });

        Schema::table('order_product', function (Blueprint $table) {
            $table->decimal('unit_cost', 12, 2)->default(0)->after('product_id');
            $table->decimal('sale_price', 12, 2)->change();
            $table->decimal('tax_amount', 12, 2)->default(0)->after('sale_price');
            $table->decimal('discount_amount', 12, 2)->default(0)->after('tax_amount');
            $table->decimal('subtotal', 12, 2)->default(0)->after('discount_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'subtotal_amount',
                'tax_amount',
                'discount_amount',
                'payment_status',
                'payment_method',
                'shipping_method',
                'tracking_number',
                'shipped_at',
                'delivered_at',
                'customer_notes',
                'internal_notes',
                'source',
                'deleted_at',
            ]);
            $table->decimal('total_amount', 10, 0)->change();
        });

        Schema::table('order_product', function (Blueprint $table) {
            $table->dropColumn([
                'unit_cost',
                'tax_amount',
                'discount_amount',
                'subtotal',
            ]);
            $table->decimal('sale_price', 10, 2)->change();
        });
    }
};
