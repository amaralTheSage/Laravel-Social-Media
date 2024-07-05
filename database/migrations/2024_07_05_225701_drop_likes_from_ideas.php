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
        // Creating another migration for dropping columns and tables is the proper way of doing it, specially in production
        // I'm dropping it here because it would be better to have a third table to record which people are liking what, etc

        Schema::table('ideas', function (Blueprint $table) {
            $table->dropColumn('likes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // I'm adding this here as a means to revert the dropping of the 'likes' column, incase its needed in the future
        Schema::table('ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('content');
            $table->unsignedInteger('likes')->default(0);
            $table->timestamps();
        });
    }
};
