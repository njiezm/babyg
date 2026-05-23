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
        Schema::create('content_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('group_name')->default('general')->index();
            $table->string('key')->unique();
            $table->string('label');
            $table->text('value')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('timeline_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->date('event_date')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('gift_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('image_url')->nullable();
            $table->boolean('is_reserved')->default(false);
            $table->string('reserved_by')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('name_options', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('name_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('name_option_id')->constrained()->cascadeOnDelete();
            $table->string('voter_name');
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });

        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('donor_name')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->default('manual');
            $table->text('note')->nullable();
            $table->boolean('confirmed')->default(true);
            $table->timestamps();
        });

        Schema::create('guestbook_messages', function (Blueprint $table) {
            $table->id();
            $table->string('author');
            $table->text('message');
            $table->boolean('is_approved')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guestbook_messages');
        Schema::dropIfExists('donations');
        Schema::dropIfExists('name_votes');
        Schema::dropIfExists('name_options');
        Schema::dropIfExists('gift_items');
        Schema::dropIfExists('timeline_events');
        Schema::dropIfExists('content_blocks');
    }
};

