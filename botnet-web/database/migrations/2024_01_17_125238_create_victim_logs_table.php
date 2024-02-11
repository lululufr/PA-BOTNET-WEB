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
        Schema::create('victim_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('victim_id')->constrained();
            $table->string('log');
            // $table->timestamp('created_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('victim_logs');
    }
};

/*
CREATE TABLE VICTIM_LOGS{
    ID INT PRIMARY KEY AUTO_INCREMENT,
    VICTIM_ID INT NOT NULL,
    LOG VARCHAR(255) NOT NULL,
    CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (VICTIM_ID) REFERENCES VICTIMS(ID)
}
*/