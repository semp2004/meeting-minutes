<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_meetings', function (Blueprint $table) {
            $table ->foreignId('user_id');
            $table ->foreignId('meeting_id');


            $table -> foreign('user_id') -> references('id') -> on('users')->onDelete('cascade');
            $table -> foreign('meeting_id') -> references('id') -> on('meetings')->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_meetings');
    }
};
