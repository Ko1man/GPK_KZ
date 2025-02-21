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
        Schema::create('attention_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attention_id');
            $table->unsignedBigInteger('old_user_id');
            $table->unsignedBigInteger('old_group_id');
            $table->date('old_date');
            $table->boolean('old_attention');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attention_log');
    }
};
