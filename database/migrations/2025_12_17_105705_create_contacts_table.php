<?php

use App\Enums\Contacts\PreferredContactMethod;
use App\Enums\Contacts\Source;
use App\Enums\Contacts\Status;
use App\Enums\Contacts\Type;
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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->onDelete('cascade');
            $table->string('contact_id')->unique();

            // Basic Info
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('landmark')->nullable();

            // Classification
            $table->string('type')->default(Type::CUSTOMER->value);
            $table->string('status')->default(Status::ACTIVE->value);
            $table->string('source')->default(Source::WEB->value);

            // B2B
            $table->string('company_name')->nullable();
            $table->string('job_title')->nullable();

            // Advanced Location
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();

            // CRM/Marketing
            $table->text('notes')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('preferred_contact_method')->default(PreferredContactMethod::EMAIL->value);
            $table->unsignedTinyInteger('engagement_score')->default(0);

            // Customization
            $table->json('custom_fields')->nullable();

            // Timestamps
            $table->timestamp('last_contacted_at')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->json('custom_contact_fields')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('custom_contact_fields');
        });
    }
};
