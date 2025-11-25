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
        Schema::create('a3', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discipline_id')->constrained('disciplines')->onDelete('cascade');
            $table->foreignId('question_response_id')->constrained('question_response')->onDelete('cascade');
            $table->foreignId('question_description_id')->constrained('question_descriptions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a3');
    }
};
