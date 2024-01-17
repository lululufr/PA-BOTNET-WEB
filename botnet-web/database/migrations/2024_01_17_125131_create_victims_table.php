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
        Schema::create('victims', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->string('ip');
            $table->string('sym_key')->nullable();
            $table->string('pub_key')->nullable();
            $table->boolean('stealth');
            $table->boolean('multi_thread');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('victims');
    }
};

/*

CREATE TABLE VICTIMS{
    ID INT PRIMARY KEY AUTO_INCREMENT,
    UID VARCHAR(255) NOT NULL,
    IP VARCHAR(255) NOT NULL,
    SYM_KEY VARCHAR(255),
    PUB_KEY VARCHAR(255),
    STEALTH BOOLEAN NOT NULL,
    MULTI_THREAD BOOLEAN NOT NULL,
    CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP
}
*/