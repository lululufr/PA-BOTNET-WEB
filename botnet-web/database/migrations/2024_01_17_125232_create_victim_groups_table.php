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
        Schema::create('victim_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('victim_id')->constrained('victims');
            $table->foreignId('group_id')->constrained('groups');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('victim_groups');
    }
};

/*
CREATE TABLE VICTIM_GROUPS{
    ID INT PRIMARY KEY AUTO_INCREMENT,
    VICTIM_ID INT NOT NULL,
    GROUP_ID INT NOT NULL,
    CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (VICTIM_ID) REFERENCES VICTIMS(ID),
    FOREIGN KEY (GROUP_ID) REFERENCES GROUPS(ID)
}
*/