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
        Schema::create('victim_attacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('victim_id')->constrained('victims');
            $table->string('type');
            $table->string('state');
            $table->string('text')->nullable();
            $table->string('result')->nullable();
            // $table->timestamp('created_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('victim_attacks');
    }
};
