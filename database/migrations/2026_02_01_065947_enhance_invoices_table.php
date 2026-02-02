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
        Schema::table('invoices', function (Blueprint $table) {
            // Reference
            $table->string('po_number')->nullable()->after('invoice_number');
            
            // Financial Snapshots
            $table->decimal('subtotal_amount', 12, 2)->default(0)->after('order_id');
            $table->decimal('tax_amount', 12, 2)->default(0)->after('subtotal_amount');
            $table->decimal('discount_amount', 12, 2)->default(0)->after('tax_amount');
            $table->decimal('delivery_charge', 12, 2)->default(0)->after('discount_amount');
            $table->string('currency', 3)->default('PKR')->after('total_amount');

            // Billing Details (Snapshots)
            $table->string('billing_name')->nullable()->after('currency');
            $table->string('billing_email')->nullable()->after('billing_name');
            $table->string('billing_phone')->nullable()->after('billing_email');
            $table->text('billing_address')->nullable()->after('billing_phone');

            // Shipping Details (Snapshots)
            $table->string('shipping_name')->nullable()->after('billing_address');
            $table->text('shipping_address')->nullable()->after('shipping_name');

            // Timestamps
            $table->timestamp('issued_at')->nullable()->after('due_date');
            $table->timestamp('paid_at')->nullable()->after('issued_at');
            $table->timestamp('cancelled_at')->nullable()->after('paid_at');

            // Notes
            $table->text('customer_notes')->nullable()->after('cancelled_at');
            $table->text('internal_notes')->nullable()->after('customer_notes');
            $table->text('terms_and_conditions')->nullable()->after('internal_notes');

            // Other
            $table->string('payment_method')->nullable()->after('status');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'po_number',
                'subtotal_amount',
                'tax_amount',
                'discount_amount',
                'delivery_charge',
                'currency',
                'billing_name',
                'billing_email',
                'billing_phone',
                'billing_address',
                'shipping_name',
                'shipping_address',
                'issued_at',
                'paid_at',
                'cancelled_at',
                'customer_notes',
                'internal_notes',
                'terms_and_conditions',
                'payment_method',
                'deleted_at',
            ]);
        });
    }
};
