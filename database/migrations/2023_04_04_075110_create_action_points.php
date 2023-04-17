<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('action_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agenda_item_id');
            $table->foreignId('assigned_to');

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('agenda_item_id')->references('id')->on('agenda_items')->onDelete('cascade');
            $table->string('title')->default("Action Point");
            $table->longText('content'); // What needs to be done

            $table->enum('status', ["OPENED", "CLOSED"])->default('OPENED'); // In Progress, Completed
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade'); // Who is responsible for completing the action point
            $table->date('assigned_date'); // When the action point was assigned
            $table->date('completed_date')->nullable(); // When the action point was completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_points');
    }
};
