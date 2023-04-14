<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('besluits', function (Blueprint $table) {
            $table->id();
            $table->foreignId("item_id")->references("id")->on("agenda_items")->onDelete("cascade");
            $table->string('besluit');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('besluits');
    }
};
