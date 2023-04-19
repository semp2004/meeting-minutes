<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('template_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->references('id')->on('templates')->onDelete('cascade');
            $table->longText('topic');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('template_topics');
    }
};
