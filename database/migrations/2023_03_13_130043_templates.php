<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();

            $table -> foreignId('user_id');

            $table->longText('content');

            $table -> foreign('user_id') -> references('id') -> on('users');



            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
