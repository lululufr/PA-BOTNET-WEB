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
        Schema::create('attacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('groups');
            $table->string('type');
            $table->string('state');
            $table->string('text')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attacks');
    }
};

/*

CREATE TABLE ATTACKS{
    ID INT PRIMARY KEY AUTO_INCREMENT,
    GROUP_ID INT NOT NULL,
    TYPE VARCHAR(255) NOT NULL,
    STATE VARCHAR(255) NOT NULL,
    TEXT VARCHAR(255),
    CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (GROUP_ID) REFERENCES GROUPS(ID)
}
*/