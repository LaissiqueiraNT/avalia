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
        Schema::table('disc_sched', function (Blueprint $table) {
            $table->unsignedBigInteger('scheduling_id')->nullable()->after('id');
            $table->foreign('scheduling_id')->references('id')->on('schedulings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disc_sched', function (Blueprint $table) {
            $table->dropForeign(['scheduling_id']);
            $table->dropColumn('scheduling_id');
        });
    }
};
