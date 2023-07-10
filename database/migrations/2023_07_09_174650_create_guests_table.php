<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('party_id')->constrained('parties');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_child');
            $table->boolean('is_guest');
            $table->boolean('is_attending')->nullable();
            $table->boolean('has_rehearsal_invite');
            $table->boolean('is_attending_rehearsal')->nullable();
            $table->enum('side', ['his', 'hers', 'both'])->nullable();
            $table->string('relation')->nullable();
            $table->text('message_to_guest')->nullable();
            $table->text('message_from_guest')->nullable();
            $table->text('notes')->nullable();
            $table->dateTime('rsvp_responded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
