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
        Schema::create('scanned_machines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attack_id');
            $table->foreign('attack_id')->references('id')->on('victim_attacks');
            $table->string('type');
            $table->string('version');
            $table->string('ip');
            $table->string('text');
            // $table->timestamp('created_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scanned_machines');
    }
};


/*
CREATE TABLE SCANNED_MACHINES{
    ID INT PRIMARY KEY AUTO_INCREMENT,
    VICTIM_ID INT NOT NULL,
    TYPE VARCHAR(255) NOT NULL,
    VERSION VARCHAR(255) NOT NULL,
    IP VARCHAR(255) NOT NULL,
    TEXT VARCHAR(255),
    CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (VICTIM_ID) REFERENCES VICTIMS(ID)
}

 */