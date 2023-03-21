<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->foreignId('user_id')->constrained();
            $table->foreignId('template_id')->nullable()->constrained();
            $table->timestamp('planned_time');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meeting');
    }
};